<?php
class SessionManager{
    public static array $sessions=[];
    public static  function ajouterSession(Session $session):void{
        self::$sessions[]=$session;
    }
    
}