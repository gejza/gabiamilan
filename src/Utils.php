<?php

namespace gam;

// base class with member properties and methods
class Utils {

    public static function is_local()
    {
        return $_SERVER['SERVER_PORT'] == '8000' || $_SERVER['SERVER_PORT'] == '3000';
    }

}