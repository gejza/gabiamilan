<?php
require_once 'vendor/autoload.php';

function g_file($page)
{
    $pages = array('sraz' => 'sraz.html', 'obrad'=>'obrad.html', 
       'obed' => 'obed.html', 'raut'=>'raut.html', 'dort'=>'dort.html', 'zabava'=>'zabava.html');
    error_log($pages);
    if(array_key_exists($page, $pages)){
        return $pages[$page];
    }
    return 'home.html';
}


/*$loader = new \Twig\Loader\ArrayLoader([
    'index' => 'Hello {{ name }}!',
]);
$twig = new \Twig\Environment($loader);

echo $twig->render('index', ['name' => 'Fabien']);*/

$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templ');
$twig = new \Twig\Environment($loader,['debug' => true,] /* ['cache' => 'compilation_cache',]*/);
$twig->addExtension(new \Twig\Extension\DebugExtension());
$twig->addExtension(new Kint\Twig\TwigExtension());

$data = array();
$dm = array();
$dm[] = array('name'=>'sraz', 'alt'=>'Příjezd');
$dm[] = array('name'=>'obrad', 'alt'=>'Obřad');
$dm[] = array('name'=>'obed', 'alt'=>'Oběd');
$dm[] = array('name'=>'raut', 'alt'=>'Raut');
$dm[] = array('name'=>'dort', 'alt'=>'Dort');
$dm[] = array('name'=>'zabava', 'alt'=>'Zábava');
$data['menu'] = $dm;

$page = $_GET['p'];
$data['page'] = $page;
$pf = g_file($page);
$data['filename'] = $pf;

echo $twig->render($pf, $data);

function g_img($src, $alt)
{
    print('<img class="mx-auto d-block" src="/img/'. $src. '?v=25" alt="'.$alt.'" />');
}

function g_menu($name, $alt)
{
    print('<div class="col-md-2 col-xs-4 menuimg">');
    print('<a href="/svatba/'.$name.'?v=26">');
    g_img($name.'.png', $alt);
    print('</a></div>');
}

/*
$condir = __DIR__ . '/page';

switch ($_GET['p'])
{
case 'sraz':
    require_once $condir . '/sraz.php';
    break;
case 'obrad':
    require_once $condir . '/obrad.php';
    break;
case 'obed':
    require_once $condir . '/obed.php';
break;
case 'raut':
    require_once $condir . '/raut.php';
    break;
case 'dort':
    require_once $condir . '/dort.php';
    break;
case 'zabava':
    require_once $condir . '/zabava.php';
    break;
default:
    require_once $condir . '/home.php';
    break;   
}
*/
