const CACHE_NAME = 'liberchain-v1';
const ASSETS_TO_CACHE = [
  '/poktan_kopi/',
  '/poktan_kopi/manifest.json',
  '/poktan_kopi/assets/images/pwa/Logo_LiberCHain.svg',
  '/poktan_kopi/assets/images/logo-liberchain.svg'
];

// CSS/JS dari CDN untuk offline fallback
const CDN_CACHE = [
  'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css',
  'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
  'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap'
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
        return caches.open(CACHE_NAME + '-cdn');
      })
      .then(cdnCache => {
        return cdnCache.addAll(CDN_CACHE).catch(err => {
          console.warn('[LiberChain SW] CDN cache skipped:', err);
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
  // Clean old caches
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cacheName => {
          if (cacheName !== CACHE_NAME && cacheName !== CACHE_NAME + '-cdn') {
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

  // For API/POST requests - network only
  if (event.request.url.includes('/auth/') || 
      event.request.url.includes('api') ||
      event.request.headers.get('Accept')?.includes('application/json')) {
    return;
  }

  // For HTML navigations - Network First
  if (event.request.mode === 'navigate') {
    event.respondWith(
      fetch(event.request)
        .then(response => {
          // Cache the latest version
          const clonedResponse = response.clone();
          caches.open(CACHE_NAME).then(cache => {
            cache.put(event.request, clonedResponse);
          });
          return response;
        })
        .catch(() => {
          // If offline, serve cached version
          return caches.match(event.request).then(cached => {
            if (cached) return cached;
            // If no cache, serve offline page
            return caches.match('/poktan_kopi/');
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
          // Return cached version and update in background
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

        // If not in cache, fetch from network
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
            // Offline fallback untuk gambar
            if (event.request.url.match(/\.(jpg|jpeg|png|gif|svg|ico)$/)) {
              return caches.match('/poktan_kopi/assets/images/pwa/Logo_LiberCHain.svg');
            }
            return new Response('Offline', { status: 503 });
          });
      })
  );
});