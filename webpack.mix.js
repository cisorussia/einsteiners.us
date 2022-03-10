let mix = require('laravel-mix');

/*
|--------------------------------------------------------------------------
| Mix Asset Management
|--------------------------------------------------------------------------
|
| Mix provides a clean, fluent API for defining some Webpack build steps
| for your Laravel applications. By default, we are compiling the CSS
| file for the application as well as bundling up all the JS files.
|
 */

/*
mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);

if (mix.inProduction()) {
    mix.version();
}
*/
mix
    // Обрабатываем JS
    .scripts(
        [
            'resources/layout/js/uikit.min.js',
            'resources/layout/js/uikit-icons.min.js',
            'resources/layout/js/action.min.js',
            'resources/layout/js/cssworld.ru-xcal.js',
        ],  
        'public/js/js.min.js'
    ).version()
    .styles(
        [
            'resources/layout/css/uikit.min.css',
            'resources/layout/css/theme.css',
            'resources/layout/css/portable.css',
        ],  
        'public/css/portable.min.css'
    ).version()
    .styles(
        [
            'resources/layout/css/uikit.min.css',
            'resources/layout/css/theme.css',
            'resources/layout/css/mobile.css',
        ],  
        'public/css/mobile.min.css'
    ).version()
    .js(
        'resources/js/app.js', 'public/js'
    ).sourceMaps()
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    // Переопределяем параметры mix
    .options({
        processCssUrls: false, // Отключаем автоматическое обновление URL в CSS
    })
    .setPublicPath('public')
    // Включаем версионность
    
    if (mix.inProduction()) {
        mix.version();
    }
