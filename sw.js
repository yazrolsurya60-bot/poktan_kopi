const CACHE_NAME = 'liberchain-v2';

// Get base path dynamically
const BASE = self.location.pathname.replace('sw.js', '');

const ASSETS_TO_CACHE = [
  BASE,
  BASE + 'manifest.json',
  BASE + 'assets/images/pwa/icon-192x192.png',
  BASE + 'assets/images/pwa/icon-512x512.png'
];

// Install service worker
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        console.log('[LiberChain SW] Caching assets');
        return cache.addAll(ASSETS_TO_CACHE).catch(err => {
          console.warn('[LiberChain SW] Some assets failed to cache:', err);
        });
      })
      .then(() => {
        console.log('[LiberChain SW] Skip waiting');
        return self.skipWaiting();
      })
  );
});

// Activate service worker
self.addEventListener('activate', event => {
  console.log('[LiberChain SW] Activated');
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cacheName => {
          if (cacheName !== CACHE_NAME) {
            console.log('[LiberChain SW] Deleting old cache:', cacheName);
            return caches.delete(cacheName);
          }
        })
      );
    }).then(() => {
      return self.clients.claim();
    })
  );
});

// Fetch strategy: Network First, fallback to cache
self.addEventListener('fetch', event => {
  // Skip non-GET requests
  if (event.request.method !== 'GET') return;

  // For HTML navigations - Network First
  if (event.request.mode === 'navigate') {
    event.respondWith(
      fetch(event.request)
        .then(response => {
          const clonedResponse = response.clone();
          caches.open(CACHE_NAME).then(cache => {
            cache.put(event.request, clonedResponse);
          });
          return response;
        })
        .catch(() => {
          return caches.match(event.request).then(cached => {
            if (cached) return cached;
            return caches.match(BASE);
          });
        })
    );
    return;
  }

  // For static assets - Cache First
  event.respondWith(
    caches.match(event.request)
      .then(cachedResponse => {
        if (cachedResponse) {
          const fetchPromise = fetch(event.request)
            .then(response => {
              if (response.ok) {
                caches.open(CACHE_NAME).then(cache => {
                  cache.put(event.request, response);
                });
              }
            })
            .catch(() => {});
          return cachedResponse;
        }

        return fetch(event.request)
          .then(response => {
            if (response.ok) {
              const clonedResponse = response.clone();
              caches.open(CACHE_NAME).then(cache => {
                cache.put(event.request, clonedResponse);
              });
            }
            return response;
          })
          .catch(() => {
            if (event.request.url.match(/\.(jpg|jpeg|png|gif|svg|ico)$/)) {
              return caches.match(BASE + 'assets/images/pwa/icon-192x192.png');
            }
            return new Response('Offline', { status: 503 });
          });
      })
  );
});