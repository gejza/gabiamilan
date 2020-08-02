<?php $fver='25'; ?>
<!DOCTYPE html>
    <html lang="cs">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest?v=<?php echo($fver); ?>">

        <title>Gabi a Milan</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="/css/bootstrap.min.css" >
        <link rel="stylesheet" type="text/css" href="/css/styl.css?v=<?php echo($fver); ?>">
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56377132-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-56377132-3');
</script>
</head>
<body>

<?php
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
?>

<div class="jumbotron text-center">
      <a href="/svatba" class=""><?php g_img('venec.png', 'Venec'); ?></a>
        </div>
   
      <div class="container">
      <div class="row">
        <?php 
            g_menu('sraz','Příjezd');
            g_menu('obrad','Obřad'); 
            g_menu('obed','Oběd'); 
            g_menu('raut','Raut'); 
            g_menu('dort','Dort'); 
            g_menu('zabava','Zábava'); 
        ?>
        </div>
      </div>


<div class="mezera"></div>

<div class="container content">
<?php

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
?>
</div>

<div class="footer">© 2020 Gabriela Štěpánová a Milan Dünghübel</div>
<a href="https://www.google.com/calendar/render?action=TEMPLATE&text=Svatba+G%2BM&location=ohrazenice&dates=20200822T020200Z%2F20200823T020200Z">Udalost</a>
<a href="/e905107989956639.ics" class="">Klendar</a>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>
