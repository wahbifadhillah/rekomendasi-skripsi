const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .copy(
        'node_modules/@fortawesome/fontawesome-free/webfonts',
        'public/webfonts'
    )
    .copy(
        'node_modules/chart.js/dist/chart.js', 
        'public/chart.js/chart.js'
    )
    .copy(
        'node_modules/viz.js/viz.js', 
        'public/viz.js/viz.js'
    )
    .copy(
        'node_modules/viz.js/full.render.js', 
        'public/viz.js/full.render.js'
    )
    .copy(
        'node_modules/interactjs/dist/interact.min.js', 
        'public/interactjs/interact.min.js'
    )
    // .copy(
    //     'node_modules/@svgdotjs/svg.draggable.js/dist/svg.draggable.js', 
    //     'public/svgdotjs/svg.draggable.js'
    // )
    // .copy(
    //     'node_modules/@svgdotjs/svg.js/dist/svg.js.map', 
    //     'public/svgdotjs/svg.js.map'
    // )
    // .copy(
    //     'node_modules/@svgdotjs/svg.draggable.js/dist/svg.draggable.js.map', 
    //     'public/svgdotjs/svg.draggable.js.map'
    // )
    ;
