<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WeddingController extends BaseController
{
    /**
     * @Route("/svatba", name="wedding")
     */
    public function index()
    {
        $data = $this->gendata();
        $data['team']  = [
            ['title' => 'Ženich', 'alt' => 'Milan', 'img' => '/img/photo/milan.jpg', 'desc' => 'Druhá nejdůležitější osoba hned po nevěstě. Hlavním cílem je, aby ženich po svých došel na manželské lože.'],
            ['title' => 'Nevěsta', 'alt' => 'Gabriela', 'img' => '/img/photo/gabi.jpg', 'desc' => 'Nejvíc nejdůležitější osoba na celé svatbě. Cokoliv si bude přát, musí jí být vyplněno.'],
            ['title' => 'Svědek Michal', 'alt' => 'Michal', 'img' => '/img/photo/michal.jpg', 'desc' => 'Michal zodpovídá za celou svatbu. V případě, že budete chtít znát nějaké informace, Michal Vám rád pomůže, bude ten nejlépe informovaný.'],
            ['title' => 'Svědkyně Míša', 'alt' => 'Míša', 'img' => '/img/photo/misa.jpg', 'desc' => 'Zde se obracejte pokud Vám bude scházet kofein, nebo v jakýkoliv organizačních záležitostech.'],
            ['title' => 'Družička Wendy', 'alt' => 'Wendy', 'img' => '/img/photo/wendy.jpg', 'desc' => 'Tady je zodpovědná osoba za zásobování, když dojde jídlo, nebo pití zkuste si vyškemrat u Wendy.'],
            ['title' => 'Družička Káťa', 'alt' => 'Káťa', 'img' => '/img/photo/kata.jpg', 'desc' => 'Tady je zodpovědná osoba za zásobování č.2, když dojde jídlo, nebo pití zkuste si vyškemrat u Wendy, když Vám nic nedá, zkuste ještě Káťu.'],
            ['title' => 'Družička Ella', 'alt' => 'Ella', 'img' => '/img/photo/ella.jpg', 'desc' => 'Od Elly se toho dá čekat hodně, ale s dotazy se na ní neobracejte. Když budete chtít něco namalovat, tak to bude ta pravá koho hledáte.'],
            ['title' => 'Mládenec Filip', 'alt' => 'Filip', 'img' => '/img/photo/filip.jpg', 'desc' => 'Za Fílou si můžete přijít popovídat. V poslední době je u něj velké téma Minecraft, takže pokud chtece herní rady, nebo diskuze, určitě rád pomůže.'],
        ];

        return $this->render('home.html.twig', $data);
    }

    /**
     * @Route("/svatba/sraz", name="wed_sraz")
     */
    public function sraz()
    {
        return $this->render('sraz.html.twig',
            $this->gendata()
        );
    }

    /**
     * @Route("/svatba/obrad", name="wed_obrad")
     */
    public function obrad()
    {
        return $this->render('obrad.html.twig',
            $this->gendata()
        );
    }

    /**
     * @Route("/svatba/dort", name="wed_dort")
     */
    public function dort()
    {
        return $this->render('dort.html.twig',
            $this->gendata()
        );
    }

    /**
     * @Route("/svatba/obed", name="wed_obed")
     */
    public function obed()
    {
        $data = $this->gendata();
        $data['tips']  = [
            ['title' => 'Hrad Valdštejn', 'img' => 'tip/valdstejn.jpg', 'url' => 'http://www.hrad-valdstejn.cz/', 'desc'=>'Valdštejn (Waldstein) je zřícenina v okrese Semily blízko Turnova, v oblasti Českého ráje. Rodový hrad pánů z Valdštejna pochází z druhé poloviny 13. století. Je jedním z nejstarších hradů v tomto kraji.'],
            ['title' => 'Zámek Hrubá Skála', 'img' => 'tip/hruba-skala.jpg', 'url' => 'https://www.cesky-raj.info/dr-cs/1253-zamek-hruba-skala.html', 'desc'=>'Romantický zámek byl postaven na pískovcových skalách na místě středověkého hradu ze 14. století. Je jednou z dominant Českého ráje. Ze zámecké věže se nabízí krásný výhled na okolní krajinu.'],
            ['title' => 'Hruboskalsko', 'img' => 'tip/hruboskalsko.jpg', 'url' => 'https://www.cesky-raj.info/dr-cs/710-hruboskalsko.html', 'desc'=>'Hruboskalsko patří mezi nejznámější skalní města a je charakteristické impozantními věžemi dosahujícími výšky až 55 metrů a strmými kaňony.'],
            ['title' => 'Klokočské skály', 'img' => 'tip/klokocske-skaly.jpg', 'url' => 'https://www.cesky-raj.info/dr-cs/687-klokocske-skaly.html', 'desc'=>'Jižně od Malé Skály se rozkládá přírodní rezervace Klokočské skály. Jedná se o souvislou skalní hradbu tvořenou prvohorními pískovci o mocnosti až 60 metrů s mnoha jeskynními dutinami.'],
            ['title' => 'Hrad trosky', 'img' => 'tip/trosky.jpg', 'url' => 'https://www.cesky-raj.info/dr-cs/1344-hrad-trosky.html', 'desc'=>'Bizarní zřícenina gotického hradu, založeného koncem 14. století pány z Vartenberka, se stala hlavním symbolem celého Českého ráje. Z věží Baba a Panna se nabízí krásný výhled na malebnou krajinu Českého ráje i okolní regiony.'],
        ];
        return $this->render('obed.html.twig',
            $data
        );
    }

    /**
     * @Route("/svatba/raut", name="wed_raut")
     */
    public function raut()
    {
        return $this->render('raut.html.twig',
            $this->gendata()
        );
    }

    /**
     * @Route("/svatba/zabava", name="wed_zabava")
     */
    public function zabava()
    {
        return $this->render('zabava.html.twig',
            $this->gendata()
        );
    }

    /**
     * @Route("/svatba/invite/{hash}", name="wed_invite")
     */
    public function invite(string $hash)
    {
        $this->addFlash(
            'notice',
            'Your changes were saved!'
        );
        // $this->addFlash() is equivalent to $request->getSession()->getFlashBag()->add()

        return $this->redirectToRoute('wedding');


        $user = $this->getUser();
        $data = $this->gendata();
        $data['hash'] = $hash;
        $data['user2'] = $user;
        $data['user'] = array('checkin' => 1);
        dump($data);
        return $this->render('invite.html.twig', $data);
    }

}
