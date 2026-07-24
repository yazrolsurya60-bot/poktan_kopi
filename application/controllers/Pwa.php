<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pwa extends CI_Controller {

    public function manifest()
    {
        header('Content-Type: application/json');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        
        $base = base_url();
        
        $manifest = array(
            'name' => 'LiberChain',
            'short_name' => 'LiberChain',
            'description' => 'Platform Rantai Pasok Kopi Terintegrasi',
            'start_url' => $base,
            'display' => 'standalone',
            'background_color' => '#FAF6F0',
            'theme_color' => '#4A2C11',
            'orientation' => 'portrait-primary',
            'lang' => 'id-ID',
            'scope' => $base,
            'icons' => array(
                array(
                    'src' => $base . 'assets/images/pwa/icon-192x192.png',
                    'sizes' => '192x192',
                    'type' => 'image/png',
                    'purpose' => 'any'
                ),
                array(
                    'src' => $base . 'assets/images/pwa/icon-512x512.png',
                    'sizes' => '512x512',
                    'type' => 'image/png',
                    'purpose' => 'any maskable'
                )
            ),
            'categories' => array('business', 'food', 'agriculture'),
            'screenshots' => array(),
            'related_applications' => array(),
            'prefer_related_applications' => false,
            'shortcuts' => array(
                array(
                    'name' => 'Beranda',
                    'short_name' => 'Beranda',
                    'description' => 'Halaman utama LiberChain',
                    'url' => $base,
                    'icons' => array(
                        array(
                            'src' => $base . 'assets/images/pwa/icon-192x192.png',
                            'sizes' => '192x192'
                        )
                    )
                ),
                array(
                    'name' => 'Produk',
                    'short_name' => 'Produk',
                    'description' => 'Lihat produk kopi',
                    'url' => $base . 'produk',
                    'icons' => array(
                        array(
                            'src' => $base . 'assets/images/pwa/icon-192x192.png',
                            'sizes' => '192x192'
                        )
                    )
                ),
                array(
                    'name' => 'Login',
                    'short_name' => 'Login',
                    'description' => 'Masuk ke akun',
                    'url' => $base . 'auth/login',
                    'icons' => array(
                        array(
                            'src' => $base . 'assets/images/pwa/icon-192x192.png',
                            'sizes' => '192x192'
                        )
                    )
                )
            )
        );
        
        echo json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
    
    public function service_worker()
    {
        header('Content-Type: application/javascript');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Service-Worker-Allowed: /');
        
        $base_url = base_url();
        
        $sw_code = <<<JS
const CACHE_NAME = 'liberchain-v3';
const BASE_URL = '$base_url';

const ASSETS_TO_CACHE = [
  BASE_URL,
  BASE_URL + 'pwa/manifest',
  BASE_URL + 'assets/images/pwa/icon-192x192.png',
  BASE_URL + 'assets/images/pwa/icon-512x512.png'
];

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

self.addEventListener('fetch', event => {
  if (event.request.method !== 'GET') return;

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
            return caches.match(BASE_URL);
          });
        })
    );
    return;
  }

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
              return caches.match(BASE_URL + 'assets/images/pwa/icon-192x192.png');
            }
            return new Response('Offline', { status: 503 });
          });
      })
  );
});
JS;
        
        echo $sw_code;
    }
}