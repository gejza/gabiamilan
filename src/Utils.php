<?php

namespace gam;

// base class with member properties and methods
class Utils {

    public static function is_local()
    {
        return $_SERVER['SERVER_PORT'] == '8000' || $_SERVER['SERVER_PORT'] == '3000';
    }

    static function gen_nav($name, $alt)
    {
        $u = '/svatba/'.$name.'#nav';
        if (\gam\Utils::is_local()) {
            $u = '/svatba.php?p='.$name.'#nav';
        }
        return array('name'=>$name, 'url'=>$u, 'alt'=>$alt);
    }
}