<?php

namespace gam;

class SvatbaPage extends BasePage
{
    function obed()
    {
        $this->data['tips']  = [ 
            ['title' => 'Hrad Valdštejn', 'img' => 'tip/valdstejn.jpg', 'url' => 'http://www.hrad-valdstejn.cz/', 'desc'=>'Valdštejn (Waldstein) je zřícenina v okrese Semily blízko Turnova, v oblasti Českého ráje. Rodový hrad pánů z Valdštejna pochází z druhé poloviny 13. století. Je jedním z nejstarších hradů v tomto kraji.'],
            ['title' => 'Zámek Hrubá Skála', 'img' => 'tip/hruba-skala.jpg', 'url' => 'https://www.cesky-raj.info/dr-cs/1253-zamek-hruba-skala.html', 'desc'=>'Romantický zámek byl postaven na pískovcových skalách na místě středověkého hradu ze 14. století. Je jednou z dominant Českého ráje. Ze zámecké věže se nabízí krásný výhled na okolní krajinu.'],
            ['title' => 'Hruboskalsko', 'img' => 'tip/hruboskalsko.jpg', 'url' => 'https://www.cesky-raj.info/dr-cs/710-hruboskalsko.html', 'desc'=>'Hruboskalsko patří mezi nejznámější skalní města a je charakteristické impozantními věžemi dosahujícími výšky až 55 metrů a strmými kaňony.'],
            ['title' => 'Klokočské skály', 'img' => 'tip/klokocske-skaly.jpg', 'url' => 'https://www.cesky-raj.info/dr-cs/687-klokocske-skaly.html', 'desc'=>'Jižně od Malé Skály se rozkládá přírodní rezervace Klokočské skály. Jedná se o souvislou skalní hradbu tvořenou prvohorními pískovci o mocnosti až 60 metrů s mnoha jeskynními dutinami.'],
            ['title' => 'Hrad trosky', 'img' => 'tip/trosky.jpg', 'url' => 'https://www.cesky-raj.info/dr-cs/1344-hrad-trosky.html', 'desc'=>'Bizarní zřícenina gotického hradu, založeného koncem 14. století pány z Vartenberka, se stala hlavním symbolem celého Českého ráje. Z věží Baba a Panna se nabízí krásný výhled na malebnou krajinu Českého ráje i okolní regiony.'],
        ];
        return $this->render('obed.html');
    }

    function g_file($page)
    {
        $pages = array('sraz' => 'sraz.html', 'obrad'=>'obrad.html', 
        'obed' => 'obed.html', 'raut'=>'raut.html', 'dort'=>'dort.html', 'zabava'=>'zabava.html', 'invite' => 'invite.html');
        if(array_key_exists($page, $pages)){
            return $pages[$page];
        }
        return 'home.html';
    }

    function page($page)
    {
        $this->data['siteurl'] = \gam\Utils::is_local() ? '/svatba.php' : '/svatba';
        $this->data['page'] = $page;


        $keyh = '';
        if (strlen($page) > 6) {
            $keyh = $page;
            $pf = 'invite.html';
        }
        else if (isset($_COOKIE['keyh'])) {
            $keyh = $_COOKIE['keyh'];
        }

        if (strlen($page) < 7) {
            $pf = $this->g_file($page);
            $this->data['filename'] = $pf;
        }

        if ($keyh != '') {
            $user = \gam\User::auth($keyh);

            if ($user) {
                $this->data['user'] = $user;

                // Setting a cookie
                setcookie('keyh', $keyh, time()+30*24*60*60);
            }
            else {
                $keyh = '';
                setcookie('keyh', '', 1);
                $pf = '404.html';
            }
        }
        $this->data['keyh'] = $keyh;

        \Kint::dump($GLOBALS, $_SERVER); // Dump any number of variables
        
        //Kint::trace(); // Dump a debug backtrace
        
        //Kint::$enabled_mode = false; // Disable kint

        $this->data['fver'] = 30;
        //if ($_GET['debug']) {
        //    $data['debug_out'] = true;
        //}


        $this->data['server'] = $_SERVER;
        \Kint::dump($_COOKIE, $_REQUEST); 


        if ($page == 'obed') {
            return $this->obed();
        }
        return $this->render($pf);
    }
}