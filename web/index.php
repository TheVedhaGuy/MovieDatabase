<?php

//include 'core/init.php';

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;
 
$dbconn = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=vraje059 user=vraje059 password=Vedha545654")
    or die('Could not connect: ' . pg_last_error());

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

$app->get('/cowsay', function() use($app) {
  $app['monolog']->addDebug('cowsay');
  return "<pre>".\Cowsayphp\Cow::say("Cool beans")."</pre>";
});

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return str_repeat('Hello', getenv('TIMES'));
});

$app->run();
