<!DOCTYPE html>
    <html lang="cs">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/ico" href="/svatba/favicon.ico" />
        <title>Gabi a Milan</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.min.css" >
        <link rel="stylesheet" type="text/css" href="styl.css?v=23">
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
    print('<img class="mx-auto d-block" src="img/'. $src. '?v=2" alt="'.$alt.'" />');
}

function g_menu($name, $alt)
{
    print('<div class="col-md-2 col-xs-4 menuimg">');
    print('<a href="?p='.$name.'">');
    g_img($name.'.png', $alt);
    print('</a></div>');
}
?>

<div class="jumbotron text-center">
      <a href="index.php" class=""><?php g_img('venec.png', 'Venec'); ?></a>
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

<div class="container">
<div class="column middle">
<?php
switch ($_GET['p'])
{
case 'sraz':
    require_once __DIR__ . '/sraz.php';
    break;
case 'obrad':
    require_once __DIR__ . '/obrad.php';
    break;
case 'obed':
    require_once __DIR__ . '/obed.php';
break;
case 'raut':
    require_once __DIR__ . '/raut.php';
    break;
case 'dort':
    require_once __DIR__ . '/dort.php';
    break;
case 'zabava':
    require_once __DIR__ . '/zabava.php';
    break;
default:
    require_once __DIR__ . '/home.php';
    break;   
}
?>
</div>
</div>

<div class="footer">© 2020 Gabriela Štěpánová a Milan Dünghübel</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
