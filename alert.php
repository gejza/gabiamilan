<?php
require_once 'vendor/autoload.php';

/*$loader = new \Twig\Loader\ArrayLoader([
    'index' => 'Hello {{ name }}!',
]);
$twig = new \Twig\Environment($loader);

echo $twig->render('index', ['name' => 'Fabien']);*/

$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates');
$twig = new \Twig\Environment($loader,['debug' => true,] /* ['cache' => 'compilation_cache',]*/);
$twig->addExtension(new \Twig\Extension\DebugExtension());
$twig->addExtension(new Kint\Twig\TwigExtension());

$data = array();
$data['siteurl'] = '/alert.php';

//Kint::dump($GLOBALS, $_SERVER); // Dump any number of variables
 
//Kint::trace(); // Dump a debug backtrace
 
//Kint::$enabled_mode = false; // Disable kint

$data['fver'] = 31;
if ($_GET['debug']) {
    $data['debug_out'] = true;
}
$page = $_GET['p'];
$data['page'] = $page;

$pf = 'alert.html';
$data['filename'] = $pf;

$data['server'] = $_SERVER;

//Kint::dump($data);
echo $twig->render($pf.'.twig', $data);