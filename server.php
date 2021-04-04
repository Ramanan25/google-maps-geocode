<?php

class Server
{
    private $bdd;
    public function __construct()
    {
        $this->bdd = (is_null($this->bdd)) ? self::connect() : $this->bdd;
    }

    static function connect()
    {
        $bdd = mysqli_connect('localhost','root','','google_maps');
        return $bdd;
    }

    public function getplace()
    {


        $sql = "SELECT * FROM map ORDER BY ville ASC";
        $qry = mysqli_query($this->bdd, $sql );
        $res = mysqli_fetch_all($qry, MYSQLI_ASSOC);
        return $res;
        
    }
}

$params = array('uri' => 'localhost/soap/server.php');
$server = new SoapServer(NULL, $params);
$server->setClass('server');
$server->handle();


?>

