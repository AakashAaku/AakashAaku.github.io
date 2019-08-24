// 1. Save the files to the user's device
// The "install" event is called when the ServiceWorker starts up.
// All ServiceWorker code must be inside events.
'use strict';


self.addEventListener('install',function(e){
    console.log("Install");

    // waitUntil tells the browser that the install event is not finished until we have
    // cached all of our files

    e.waitUntil(
        // Here we call our cache "myonsenuipwa", but you can name it anything unique

        caches.open("pwdTest").then((cache)=>{
             // If the request for any of these resources fails, _none_ of the resources will be
            // added to the cache.
            return cache.addAll([
                '/',
                '/index.html',
                '/https://unpkg.com/onsenui/css/onsenui.min.css',
                '/https://unpkg.com/onsenui/css/onsen-css-components.min.css',
                '/https://unpkg.com/onsenui/js/onsenui.min.js',
            ]);  
        })
    );
});


// 2. Intercept requests and return the cached version instead

self.addEventListener('fetch',function(e){
 console.log('The service worker is serving the asset.');
   e.respondWith(
     // check if this file exists in the cache
     caches.match(e.request).then(response=>response || fetch(e.request))
   );
});