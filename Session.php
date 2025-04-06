<?php
include_once 'Etudiant.php';
class Session{
    private array $etudiants=[];
    private int $idSession;
    public static int $c=0;

    public function __construct(){//le constructeur va creer la session si elle n'existe pas et va la lier à la variable $etudiants si elle existe déja
        session_start();
        if(!isset($_SESSION['etudiants'])){
            $_SESSION['etudiants']=[];
        }
        if(!isset($_SESSION["compteur"])){
            $_SESSION["compteur"]=0;
        }
    
    $this->etudiants=$_SESSION['etudiants'];//pour que la variable $etudiants contienne ce qu'il ya dans $_SESSION['etudiants'] dejà
    self::$c=$_SESSION["compteur"];//sinon la variable $c va etre réinitialisée à 0 à chaque fois qu'on recharge la page
    $this->idSession=self::$c++;//incrementation de la variable statique $c pour chaque nouvelle session
    $_SESSION["compteur"]=self::$c;//pour que la variable de session globale contienne le compteur mis à jour

    }
    public function ajouterEtudiant(Etudiant $etudiant):void{
        $this->etudiants[]=$etudiant;
        $_SESSION['etudiants']=$this->etudiants;//pour que la variable de session contienne le tableau d'etudiants mis à jour
    
    }
        public function getEtudiants():array{
        return $this->etudiants;
    }
    public function getId(){
        return $this->idSession;
    }


}





?>