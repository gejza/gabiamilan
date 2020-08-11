<?php

//use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\ErrorHandler\Debug;
//use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/vendor/autoload.php';

(new Dotenv())->bootEnv(__DIR__.'/.env');

if ($_SERVER['APP_DEBUG']) {
    umask(0000);

    Debug::enable();
}

//require_once 'vendor/autoload.php';

mb_internal_encoding("UTF-8");

// function is_local()
// {
//     return $_SERVER['SERVER_PORT'] == '8000' || $_SERVER['SERVER_PORT'] == '3000';
// }

// function check_invite($key)
// {
//     // Create connection
//     $conn = new mysqli(is_local() ? 'localhost':'md84.wedos.net','a251653_sv1','Svatba_228','d251653_sv1');
//     if ($conn->connect_error) {
//         die('Nepodařilo se připojit k MySQL serveru (' . $conn->connect_errno . ') '. $conn->connect_error);
//     }
//     // Escape special characters, if any
//     $key2 = $conn->real_escape_string($key);
//     $sql="SELECT * FROM invite WHERE `keyh`='$key2'";
//     //Kint::dump($sql);
//     //Kint::trace();
//     $ret = false;

//     if ($vysledek = $conn->query($sql)) {
//         // echo 'Z databáze jsme získali ' . $vysledek->num_rows . ' uživatelů.';

//         while ($uzivatel = $vysledek->fetch_assoc())
//         {
//             //Kint::dump($uzivatel);
//         //printf("%s %s \n", $uzivatel['Jmeno'], $uzivatel['Prijmeni']);
//             $ret = true;
//         }
//         $vysledek->free_result();
    
//     }

//     $conn->close();
//     return $ret;
// }





/*$loader = new \Twig\Loader\ArrayLoader([
    'index' => 'Hello {{ name }}!',
]);
$twig = new \Twig\Environment($loader);

echo $twig->render('index', ['name' => 'Fabien']);*/


// $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates');
// $twig = new \Twig\Environment($loader,['debug' => true,] /* ['cache' => 'compilation_cache',]*/);
// $twig->addExtension(new \Twig\Extension\DebugExtension());
// $twig->addExtension(new Kint\Twig\TwigExtension());

 


$pagectl = new \gam\SvatbaPage();



// $data['team']  = [ 
//     ['title' => 'Ženich', 'alt' => 'Milan', 'img' => '/img/photo/milan.jpg', 'desc' => 'Druhá nejdůležitější osoba hned po nevěstě. Hlavním cílem je, aby ženich po svých došel na manželské lože.'],
//     ['title' => 'Nevěsta', 'alt' => 'Gabriela', 'img' => '/img/photo/gabi.jpg', 'desc' => 'Nejvíc nejdůležitější osoba na celé svatbě. Cokoliv si bude přát, musí jí být vyplněno.'],
//     ['title' => 'Svědek Michal', 'alt' => 'Michal', 'img' => '/img/photo/michal.jpg', 'desc' => 'Michal zodpovídá za celou svatbu. V případě, že budete chtít znát nějaké informace, Michal Vám rád pomůže, bude ten nejlépe informovaný.'],
//     ['title' => 'Svědkyně Míša', 'alt' => 'Míša', 'img' => '/img/photo/misa.jpg', 'desc' => 'Zde se obracejte pokud Vám bude scházet kofein, nebo v jakýkoliv organizačních záležitostech.'],
//     ['title' => 'Družička Wendy', 'alt' => 'Wendy', 'img' => '/img/photo/wendy.jpg', 'desc' => 'Tady je zodpovědná osoba za zásobování, když dojde jídlo, nebo pití zkuste si vyškemrat u Wendy.'],
//     ['title' => 'Družička Káťa', 'alt' => 'Káťa', 'img' => '/img/photo/kata.jpg', 'desc' => 'Tady je zodpovědná osoba za zásobování č.2, když dojde jídlo, nebo pití zkuste si vyškemrat u Wendy, když Vám nic nedá, zkuste ještě Káťu.'],
//     ['title' => 'Družička Ella', 'alt' => 'Ella', 'img' => '/img/photo/ella.jpg', 'desc' => 'Od Elly se toho dá čekat hodně, ale s dotazy se na ní neobracejte. Když budete chtít něco namalovat, tak to bude ta pravá koho hledáte.'],
//     ['title' => 'Mládenec Filip', 'alt' => 'Filip', 'img' => '/img/photo/filip.jpg', 'desc' => 'Za Fílou si můžete přijít popovídat. V poslední době je u něj velké téma Minecraft, takže pokud chtece herní rady, nebo diskuze, určitě rád pomůže.'],
// ];


// Kint::dump($data);
// echo $twig->render($pf.'.twig', $data);

try {
    $page = array_key_exists('p', $_REQUEST) ? $_REQUEST['p'] : '';
    echo $pagectl->page($page);
}
catch (Exception $e) {
    echo $e->getMessage();
}



/*
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
*/

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
