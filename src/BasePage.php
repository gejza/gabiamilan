<?php

namespace gam;

// base class with member properties and methods
class BasePage {


    var $data;

    function __construct()
    {
        $this->data = array();

        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../templates');
        $this->twig = new \Twig\Environment($loader,['debug' => false,] /* ['cache' => 'compilation_cache',]*/);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
        $this->twig->addExtension(new \Kint\Twig\TwigExtension());
        $this->twig->addFunction(
            new \Twig\TwigFunction('getenv', function ($key) {
                return $_SERVER[$key];
            })
        );

        $this->data['gitcommit'] = file_get_contents(__DIR__.'/../git.version');

        $this->data['team']  = [ 
            ['title' => 'Ženich', 'alt' => 'Milan', 'img' => '/img/photo/milan.jpg', 'desc' => 'Druhá nejdůležitější osoba hned po nevěstě. Hlavním cílem je, aby ženich po svých došel na manželské lože.'],
            ['title' => 'Nevěsta', 'alt' => 'Gabriela', 'img' => '/img/photo/gabi.jpg', 'desc' => 'Nejvíc nejdůležitější osoba na celé svatbě. Cokoliv si bude přát, musí jí být vyplněno.'],
            ['title' => 'Svědek Michal', 'alt' => 'Michal', 'img' => '/img/photo/michal.jpg', 'desc' => 'Michal zodpovídá za celou svatbu. V případě, že budete chtít znát nějaké informace, Michal Vám rád pomůže, bude ten nejlépe informovaný.'],
            ['title' => 'Svědkyně Míša', 'alt' => 'Míša', 'img' => '/img/photo/misa.jpg', 'desc' => 'Zde se obracejte pokud Vám bude scházet kofein, nebo v jakýkoliv organizačních záležitostech.'],
            ['title' => 'Družička Wendy', 'alt' => 'Wendy', 'img' => '/img/photo/wendy.jpg', 'desc' => 'Tady je zodpovědná osoba za zásobování, když dojde jídlo, nebo pití zkuste si vyškemrat u Wendy.'],
            ['title' => 'Družička Káťa', 'alt' => 'Káťa', 'img' => '/img/photo/kata.jpg', 'desc' => 'Tady je zodpovědná osoba za zásobování č.2, když dojde jídlo, nebo pití zkuste si vyškemrat u Wendy, když Vám nic nedá, zkuste ještě Káťu.'],
            ['title' => 'Družička Ella', 'alt' => 'Ella', 'img' => '/img/photo/ella.jpg', 'desc' => 'Od Elly se toho dá čekat hodně, ale s dotazy se na ní neobracejte. Když budete chtít něco namalovat, tak to bude ta pravá koho hledáte.'],
            ['title' => 'Mládenec Filip', 'alt' => 'Filip', 'img' => '/img/photo/filip.jpg', 'desc' => 'Za Fílou si můžete přijít popovídat. V poslední době je u něj velké téma Minecraft, takže pokud chtece herní rady, nebo diskuze, určitě rád pomůže.'],
        ];
        // encode array to json
        $json = json_encode($this->data['team']);
        file_put_contents("data.json", $json);

        $dm = array();
        $dm[] = \gam\Utils::gen_nav('sraz', 'Příjezd');
        $dm[] = \gam\Utils::gen_nav('obrad', 'Obřad');
        $dm[] = \gam\Utils::gen_nav('obed', 'Oběd');
        $dm[] = \gam\Utils::gen_nav('raut', 'Raut');
        $dm[] = \gam\Utils::gen_nav('dort', 'Dort');
        $dm[] = \gam\Utils::gen_nav('zabava', 'Zábava');

//        if ($keyh != '') {
//            $dm[] = \gam\Utils::gen_nav('invite', 'Pozvani');
//        }

        $this->data['debug_out'] = 1;
        $this->data['menu'] = $dm;

        $this->pf = 'home.html';
    }

    function render($pf)
    {
        \Kint::dump($this->data);
        return $this->twig->render($pf.'.twig', $this->data);
    }
 

 } // end of class Vegetable