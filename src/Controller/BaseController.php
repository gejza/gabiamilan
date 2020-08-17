<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    function gendata()
    {
        $data = array();
        $data['controller_name'] = 'WeddingController';
        //$gitfile = __DIR__.'/../../git.version';
        //$data['gitcommit'] = file_exists($gitfile) ? file_get_contents($gitfile) : 'dev';
        $data['fver'] = 32;
        $data['siteurl'] = 'none';
        $data['keyh'] = '';
        $data['team'] = array();

        $dm = array();
        $dm[] = $this->gen_nav('sraz', 'Příjezd');
        $dm[] = $this->gen_nav('obrad', 'Obřad');
        $dm[] = $this->gen_nav('obed', 'Oběd');
        $dm[] = $this->gen_nav('raut', 'Raut');
        $dm[] = $this->gen_nav('dort', 'Dort');
        $dm[] = $this->gen_nav('zabava', 'Zábava');
        $data['menu'] = $dm;
        return $data;
    }

    function gen_nav($name, $alt)
    {
        //$u = '/svatba/'.$name.'#nav';
        $u = $this->generateUrl('wed_'.$name);
        return array('name'=>$name, 'url'=>$u, 'alt'=>$alt);
    }
}
