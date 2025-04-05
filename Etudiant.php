<?php
class Etudiant{
    public string $nom="";
    public array $notes=[];
 
    public function __construct(string $nom){
        $this->nom=$nom;

    }
    public function affichage():void{
        echo "<br>".$this->nom.":[";
        for($i=0;$i<count($this->notes)-1;$i++ ){
            echo $this->notes[$i],",";
        }
        echo $this->notes[$i]."]<br>";
    }
    public function calculMoyenne():float{
        $somme=0;
        foreach($this->notes as $note){
            $somme+=$note;
        }
        return $somme/count($this->notes);
    } 
    public function etat():bool{
        if(calculMoyenne()>=10){
            echo "admis(e)";
        }
        else{
            echo "non admis(e)";
        }
    }
    public function ajouterNote(float $note){
        $this->notes[]=$note;
    }

}
?>