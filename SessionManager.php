<?php
include_once 'Session.php';
class SessionManager{
    public static array $sessions=[];
    public static  function ajouterSession(Session $session):void{
        self::$sessions[]=$session;
    }
    public static function existSession(Session $session):bool{
        foreach(self::$sessions as $s){
            if($s->getId()==$session->getId()){
                return true;
            }
        }
        return false;
    }

}