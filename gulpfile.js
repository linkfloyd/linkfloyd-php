process.env.DISABLE_NOTIFIER = true;
var elixir = require('laravel-elixir');

elixir(function (mix) {

    mix.scripts([
        '/jquery/dist/jquery.min.js',
        //'/bootstrap/dist/js/bootstrap.min.js',
    ], 'web/assets/js/scripts.js', 'bower_components');

    mix.styles([
        //'/bootstrap/dist/css/bootstrap.min.css',
        '/FloydStyle/dist/css/floydstyle.css',
    ], 'web/assets/css/stylesheets.css', 'bower_components');

    mix.styles([
        'custom.css',
    ], 'web/assets/css/linkfloyd.css');
    mix.copy('bower_components/bootstrap/dist/fonts', 'web/assets/fonts');
    mix.copy('bower_components/FloydStyle/example/images/logo.png', 'web/assets/logo.png');
});
