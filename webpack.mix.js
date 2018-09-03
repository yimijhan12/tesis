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


mix.styles([
    'resources/assets/plantilla/css/bootstrap.min.css',
    'resources/assets/plantilla/font-awesome/css/font-awesome.css',
    'resources/assets/plantilla/css/plugins/toastr/toastr.min.css',
    'resources/assets/plantilla/js/plugins/gritter/jquery.gritter.css',
    'resources/assets/plantilla/css/animate.css',
    'resources/assets/plantilla/css/style.css',
    
], 'public/css/plantilla.css');


mix.scripts([
	//<!-- Mainly scripts -->
    'resources/assets/plantilla/js/jquery-3.1.1.min.js',
    'resources/assets/plantilla/js/bootstrap.min.js',
    'resources/assets/plantilla/js/plugins/metisMenu/jquery.metisMenu.js',
    'resources/assets/plantilla/js/plugins/slimscroll/jquery.slimscroll.min.js',
    // <!-- Flot -->
    'resources/assets/plantilla/js/plugins/flot/jquery.flot.js',
    'resources/assets/plantilla/js/plugins/flot/jquery.flot.tooltip.min.js',
    'resources/assets/plantilla/js/plugins/flot/jquery.flot.spline.js',
    'resources/assets/plantilla/js/plugins/flot/jquery.flot.resize.js',
    'resources/assets/plantilla/js/plugins/flot/jquery.flot.pie.js',
    // <!-- Peity -->
    'resources/assets/plantilla/js/plugins/peity/jquery.peity.min.js',
    'resources/assets/plantilla/js/demo/peity-demo.js',
    //<!-- Custom and plugin javascript -->
    'resources/assets/plantilla/js/inspinia.js',
    'resources/assets/plantilla/js/plugins/pace/pace.min.js',
    // <!-- jQuery UI -->
    'resources/assets/plantilla/js/plugins/jquery-ui/jquery-ui.min.js',
     //<!-- GITTER -->
    'resources/assets/plantilla/js/plugins/gritter/jquery.gritter.min.js',
    // <!-- Sparkline -->
    'resources/assets/plantilla/js/plugins/sparkline/jquery.sparkline.min.js',
    //    <!-- Sparkline demo data  -->
    'resources/assets/plantilla/js/demo/sparkline-demo.js',
    //    <!-- ChartJS-->
    'resources/assets/plantilla/js/plugins/chartJs/Chart.min.js',
    //    <!-- Toastr -->
    'resources/assets/plantilla/js/plugins/toastr/toastr.min.js',

    'resources/assets/plantilla/js/sweetalert2.js',
    
], 'public/js/plantilla.js')
.js(['resources/assets/js/app.js'],'public/js/app.js');






