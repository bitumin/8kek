var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    //sass to css
    mix.sass([
        'app.scss'
    ], 'public/assets/css');

    //es6 to es5
    //assumes paths relative to resources/assets/js
    //outputs to public/js by default
    mix.webpack(
        './resources/assets/js/app.js',
        './public/js'
    );

    //multiple custom javascript into one file (minifies)
    //assumes paths relative to resources/assets/js
    //outputs to public/js/all.js by default
    mix.scripts([
        'order.js',
        'forum.js'
    ], 'public/js/all.js');

    //combine multiple js files into one, it tries to minify them
    //The resulting JavaScript will be placed in public/js/all.js
    mix.scriptsIn('public/js/some/directory');

    //combine multiple js libs and sources into one file
    //useful when combining already minified code (third-party libraries)
    //The resulting JavaScript will be placed in public/js/all.js
    // mix.combine();

    // The version method accepts a file name relative to the public directory,
    // and will append a unique hash to the filename, allowing for cache-busting.
    // For example, the generated file name will look something like: all-16d570a7.css
    // And can be linked using <link rel="stylesheet" href="{{ elixir('css/all.css') }}">
    // or <script src="{{ elixir('js/app.js') }}"></script>
    mix.version([
        'css/all.css',
        'js/app.js'
    ]);
});
