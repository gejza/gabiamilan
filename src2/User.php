<?php

namespace gam;

// base class with member properties and methods
class User {

    var $id;
    var $color;
    var $data;
    var $checkin;
 
    function __construct($id, $color="green")
    {
        $this->id = $id;
        $this->color = $color;
        $this->checkin = -1;
    }
 
    function get_id()
    {
        return $this->id;
    }
 
    function what_color()
    {
        return $this->color;
    }

    public static function auth($key) 
    {
        // Create connection
        $conn = new \mysqli(\gam\Utils::is_local() ? 'localhost':'md84.wedos.net','a251653_sv1','Svatba_228','d251653_sv1');
        if ($conn->connect_error) {
            die('Nepodařilo se připojit k MySQL serveru (' . $conn->connect_errno . ') '. $conn->connect_error);
        }
        // Escape special characters, if any
        $key2 = $conn->real_escape_string($key);
        $sql="SELECT * FROM invite WHERE `keyh`='$key2'";
        //Kint::dump($sql);
        //Kint::trace();
        $ret = false;

        if ($vysledek = $conn->query($sql)) {
            // echo 'Z databáze jsme získali ' . $vysledek->num_rows . ' uživatelů.';

            while ($uzivatel = $vysledek->fetch_assoc())
            {
                $ret = new User($uzivatel['id']);
                $ret->data = $uzivatel;
                $ret->checkin = 0;
                //Kint::dump($uzivatel);
            //printf("%s %s \n", $uzivatel['Jmeno'], $uzivatel['Prijmeni']);
            
            }
            $vysledek->free_result();
        
        }

        $conn->close();
        return $ret;
    }
 
 } // end of class Vegetable