<?php
require_once 'vendor/autoload.php';

function is_local()
{
    return $_SERVER['SERVER_PORT'] == '8000' || $_SERVER['SERVER_PORT'] == '3000';
}

function check_invite($key)
{
    // Create connection
    $conn = new mysqli(is_local() ? 'localhost':'md84.wedos.net','a251653_sv1','Svatba_228','d251653_sv1');
    if ($conn->connect_error) {
        die('Nepodařilo se připojit k MySQL serveru (' . $conn->connect_errno . ') '. $conn->connect_error);
    }
    // Escape special characters, if any
    $key2 = $conn->real_escape_string($key);
    $sql="SELECT * FROM invite WHERE `key`='$key2'";
    //Kint::dump($sql);
    if ($vysledek = $conn->query($sql)) {
        echo 'Z databáze jsme získali ' . $vysledek->num_rows . ' uživatelů.';

        while ($uzivatel = $vysledek->fetch_assoc())
        {
            Kint::dump($uzivatel);
        printf("%s %s \n", $uzivatel['Jmeno'], $uzivatel['Prijmeni']);
        }
        $vysledek->free_result();
    
    }

    $conn->close();
}

function g_file($page)
{
    $pages = array('sraz' => 'sraz.html', 'obrad'=>'obrad.html', 
       'obed' => 'obed.html', 'raut'=>'raut.html', 'dort'=>'dort.html', 'zabava'=>'zabava.html');
    if(array_key_exists($page, $pages)){
        return $pages[$page];
    }
    return 'home.html';
}

function gen_nav($name, $alt)
{
    $u = '/svatba/'.$name.'#nav';
    if (is_local()) {
        $u = '/svatba.php?p='.$name.'#nav';
    }
    return array('name'=>$name, 'url'=>$u, 'alt'=>$alt);
}

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
$data['siteurl'] = is_local() ? '/svatba.php' : '/svatba';
$dm = array();
$dm[] = gen_nav('sraz', 'Příjezd');
$dm[] = gen_nav('obrad', 'Obřad');
$dm[] = gen_nav('obed', 'Oběd');
$dm[] = gen_nav('raut', 'Raut');
$dm[] = gen_nav('dort', 'Dort');
$dm[] = gen_nav('zabava', 'Zábava');
$data['menu'] = $dm;

//Kint::dump($GLOBALS, $_SERVER); // Dump any number of variables
 
//Kint::trace(); // Dump a debug backtrace
 
//Kint::$enabled_mode = false; // Disable kint

$data['fver'] = 28;
if ($_GET['debug']) {
    $data['debug_out'] = true;
}
$page = $_GET['p'];
$data['page'] = $page;

if (strlen($page) > 6) {
    check_invite($page);
    $pf = 'invite.html';
    $pf = '404.html';
}
else {
    $pf = g_file($page);
    $data['filename'] = $pf;
}

$data['server'] = $_SERVER;

if ($page == 'obed') {
    $data['tips']  = [ 
        ['title' => 'Hrad Valdštejn', 'img' => 'tip/valdstejn.jpg', 'url' => 'http://www.hrad-valdstejn.cz/', 'desc'=>'Valdštejn (Waldstein) je zřícenina v okrese Semily blízko Turnova, v oblasti Českého ráje. Rodový hrad pánů z Valdštejna pochází z druhé poloviny 13. století. Je jedním z nejstarších hradů v tomto kraji.'],
        ['title' => 'Zámek Hrubá Skála', 'img' => 'tip/hruba-skala.jpg', 'url' => 'https://www.cesky-raj.info/dr-cs/1253-zamek-hruba-skala.html', 'desc'=>'Romantický zámek byl postaven na pískovcových skalách na místě středověkého hradu ze 14. století. Je jednou z dominant Českého ráje. Ze zámecké věže se nabízí krásný výhled na okolní krajinu.'],
        ['title' => 'Hruboskalsko', 'img' => 'tip/hruboskalsko.jpg', 'url' => 'https://www.cesky-raj.info/dr-cs/710-hruboskalsko.html', 'desc'=>'Hruboskalsko patří mezi nejznámější skalní města a je charakteristické impozantními věžemi dosahujícími výšky až 55 metrů a strmými kaňony.'],
        ['title' => 'Klokočské skály', 'img' => 'tip/klokocske-skaly.jpg', 'url' => 'https://www.cesky-raj.info/dr-cs/687-klokocske-skaly.html', 'desc'=>'Jižně od Malé Skály se rozkládá přírodní rezervace Klokočské skály. Jedná se o souvislou skalní hradbu tvořenou prvohorními pískovci o mocnosti až 60 metrů s mnoha jeskynními dutinami.'],
        ['title' => 'Hrad trosky', 'img' => 'tip/trosky.jpg', 'url' => 'https://www.cesky-raj.info/dr-cs/1344-hrad-trosky.html', 'desc'=>'Bizarní zřícenina gotického hradu, založeného koncem 14. století pány z Vartenberka, se stala hlavním symbolem celého Českého ráje. Z věží Baba a Panna se nabízí krásný výhled na malebnou krajinu Českého ráje i okolní regiony.'],
    ];
}

//Kint::dump($data);
echo $twig->render($pf.'.twig', $data);

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
