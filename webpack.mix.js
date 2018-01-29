let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')


   .combine(
        [
        	'resources/assets/js/jquery.min.js',
        	'resources/assets/js/bootstrap.min.js',
        	'resources/assets/js/jquery-ui.min.js',
        	'resources/assets/js/plugins/tables/datatables/datatables.min.js',
        	'resources/assets/js/plugins/tables/datatables/extensions/buttons.min.js',
        	'resources/assets/js/plugins/tables/datatables/extensions/responsive.min.js',
        	'resources/assets/js/popper.js',
        	'resources/assets/core/app.js',
        	'resources/assets/js/popover.js',
        	'resources/assets/core/interactions.min.js',
        	'resources/assets/js/plugins/loaders/pace.min.js',
        	'resources/assets/js/plugins/loaders/progressbar.min.js',
        	'resources/assets/js/plugins/loaders/blockui.min.js',
        	'resources/assets/js/plugins/visualization/d3/d3.min.js',
            'resources/assets/js/plugins/visualization/d3/d3_tooltip.js',
            'resources/assets/js/plugins/ui/moment/moment.min.js',
            'resources/assets/js/plugins/forms/styling/uniform.min.js',
            'resources/assets/js/plugins/forms/styling/switchery.min.js',
            'resources/assets/js/plugins/pickers/daterangepicker.js',
            'resources/assets/js/plugins/forms/selects/bootstrap_multiselect.js',

        ], './public/js/scripts.js'
    )

   .combine(
        [
        	'resources/assets/css/bootstrap.css',
        	'resources/assets/css/core.css',
        	'resources/assets/css/components.css',
        	'resources/assets/css/colors.css',
        	'resources/assets/css/jquery-ui.min.css',
        	'resources/assets/css/dev.css',
        	'node_modules/font-awesome/css/font-awesome.css',
        	'resources/assets/css/icons/icomoon/styles.css',
        	'resources/assets/css/google_fonts.css',
        ], './public/css/main.css'
    )

   .copy('node_modules/font-awesome/fonts', 'public/fonts');
