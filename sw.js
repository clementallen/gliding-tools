importScripts('node_modules/sw-toolbox/sw-toolbox.js');

var precacheList = [
    './',
    './assets/js/config.js',
    './assets/js/main.js',
    './assets/js/validators.js',
    './assets/js/glide.js',
    './assets/js/bgaHandicaps.js',
    './assets/js/handicap.js',
    './assets/js/silver.js',
    './assets/js/weight.js',
    './assets/js/vendor/jquery.js',
    './assets/js/vendor/list.js',
    './assets/js/vendor/require.js',
    './assets/css/bootstrap.min.css',
    './assets/css/gliding.css'
];

toolbox.precache(precacheList);

toolbox.router.get('/(.*)', toolbox.fastest);
