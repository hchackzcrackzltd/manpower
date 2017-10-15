const { mix } = require('laravel-mix');

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
  'public/adminlte/plugins/normalize.css',
  'public/adminlte/bootstrap/css/bootstrap.min.css',
  'public/adminlte/plugins/font-awesome/css/font-awesome.min.css',
  'public/adminlte/plugins/ionicons/css/ionicons.min.css',
  'public/adminlte/dist/css/skins/skin-blue.min.css',
  'public/adminlte/plugins/datatables/dataTables.bootstrap.min.css',
  'public/adminlte/plugins/datepicker/bootstrap-datepicker3.min.css',
  'public/adminlte/plugins/iCheck/square/green.css',
  'public/adminlte/plugins/animate.css',
  'public/adminlte/plugins/select2/select2.min.css',
  'public/adminlte/dist/css/alt/AdminLTE-select2.min.css',
  'public/adminlte/plugins/ionicons/css/ionicons.min.css',
  'public/adminlte/plugins/rating/dist/themes/fontawesome-stars.css',
  'public/adminlte/plugins/ionslider/ion.rangeSlider.css',
  'public/adminlte/plugins/ionslider/ion.rangeSlider.skinHTML5.css',
  'node_modules/sweetalert2/dist/sweetalert2.min.css',
  'resources/assets/plugins/pace/pace.css'
], 'public/css/user.min.css');

mix.styles([
  'public/adminlte/plugins/normalize.css',
  'public/adminlte/bootstrap/css/bootstrap.min.css',
  'public/adminlte/plugins/font-awesome/css/font-awesome.min.css',
  'public/adminlte/plugins/ionicons/css/ionicons.min.css',
  'public/adminlte/dist/css/skins/skin-blue-light.min.css',
  'public/adminlte/plugins/datatables/dataTables.bootstrap.min.css',
  'public/adminlte/plugins/datatables/Buttons-1.3.1/css/buttons.dataTables.min.css',
  'public/adminlte/plugins/datepicker/bootstrap-datepicker3.min.css',
  'public/adminlte/plugins/iCheck/square/green.css',
  'public/adminlte/plugins/animate.css',
  'public/adminlte/plugins/select2/select2.min.css',
  'public/adminlte/dist/css/alt/AdminLTE-select2.min.css',
  'public/adminlte/plugins/ionicons/css/ionicons.min.css',
  'node_modules/sweetalert2/dist/sweetalert2.min.css',
  'resources/assets/plugins/pace/pace.css'
], 'public/css/admin.min.css');

mix.scripts([
  'public/adminlte/plugins/jQuery/jquery-3.2.1.min.js',
  'public/adminlte/bootstrap/js/bootstrap.min.js',
  'public/adminlte/plugins/slimScroll/jquery.slimscroll.min.js',
  'public/adminlte/dist/js/app.min.js',
  'public/adminlte/plugins/datatables/datatables.min.js',
  'public/adminlte/plugins/datatables/dataTables.bootstrap.min.js',
  'public/adminlte/plugins/datepicker/bootstrap-datepicker.min.js',
  'public/adminlte/plugins/select2/select2.full.min.js',
  'public/adminlte/plugins/iCheck/icheck.min.js',
  'public/adminlte/plugins/bootstrap-notify/bootstrap-notify.min.js',
  'public/adminlte/plugins/rating/dist/jquery.barrating.min.js',
  'public/adminlte/plugins/ionslider/ion.rangeSlider.min.js',
  'node_modules/sweetalert2/dist/sweetalert2.min.js',
  'resources/assets/plugins/pace/pace.js',
  'public/adminlte/plugins/notify.js',
],'public/js/user.min.js');

mix.scripts([
  'public/adminlte/plugins/jQuery/jquery-3.2.1.min.js',
  'public/adminlte/bootstrap/js/bootstrap.min.js',
  'public/adminlte/plugins/slimScroll/jquery.slimscroll.min.js',
  'public/adminlte/dist/js/app.min.js',
  'public/adminlte/plugins/datatables/datatables.min.js',
  'public/adminlte/plugins/datatables/dataTables.bootstrap.min.js',
  'public/adminlte/plugins/datatables/Buttons-1.3.1/js/dataTables.buttons.min.js',
  'public/adminlte/plugins/datepicker/bootstrap-datepicker.min.js',
  'public/adminlte/plugins/select2/select2.full.min.js',
  'public/adminlte/plugins/iCheck/icheck.min.js',
  'public/adminlte/plugins/bootstrap-notify/bootstrap-notify.min.js',
  'node_modules/sweetalert2/dist/sweetalert2.min.js',
  'public/adminlte/plugins/clipboard/dist/clipboard.min.js',
  'resources/assets/plugins/pace/pace.js',
  'public/adminlte/plugins/notify.js',
],'public/js/admin.min.js');
