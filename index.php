<?php
include "Etudiant.php";


session_start();

//session_destroy();
$title="Formulaire Étudiant";





include "header.php";

?>
<div class="container mt-5">
  <h2 class="mb-4">Saisie des informations d’un étudiant</h2>
  <form  method="post">
    <div class="mb-3">
      <label for="nom" class="form-label">Nom de l'étudiant</label>
      <input type="text" class="form-control" id="nom" name="nom" required>
    </div>
  

    <div class="mb-3">
      <label for="note" class="form-label">Note </label>
      <input type="number" step="0.01" class="form-control" id="note" name="note" required>

    </div>
    <button type="submit" class="btn btn-outline-secondary">soumettre</button>

     <?php
     if(!isset($_SESSION['etudiants'])){
      $_SESSION['etudiants']=[];//$_SESSION contient maintenant un tableau d' etudiants 
      }

     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $verif=false;
     
     foreach($_SESSION['etudiants'] as $etudiant){
        if($etudiant instanceof Etudiant and $etudiant->nom==$_POST['nom'] ){
            $etudiant->ajouterNote($_POST['note']);
            $verif=true;
            break;
        
        }
     } 
     if(!$verif){
        $new=new Etudiant($_POST['nom']);
        $new->ajouterNote($_POST['note']);
        $_SESSION['etudiants'][]=$new;//$_SESSION['etudiants'] est un array d'etudiants



     } 

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;//redirection à la mm page pour eviter le rechargement de la mm dernière note dans $_POST à chaque reload

  }
?>
</form>

<div class="container mt-5">
  <h3 class="mb-4">Liste des Étudiants</h3>
  <table class="table table-striped">
    <thead>
      <tr>
        <?php
        // Créer l'en-tête du tableau (les noms des étudiants)
            foreach ($_SESSION['etudiants'] as $etudiant): ?>
              <th><?php echo $etudiant->nom; ?></th>
        <?php endforeach;  ?>
      </tr>
    </thead>
    <tbody>
      <?php
      // Trouver le nombre maximal de notes pour un étudiant
      $maxNotes = 0;
      foreach ($_SESSION['etudiants'] as $etudiant) {
          $maxNotes = max($maxNotes, count($etudiant->notes));
      }
      
      // Afficher les lignes du tableau pour les notes
      for ($i = 0; $i < $maxNotes; $i++):
      ?>
        <tr>
          <?php
          // Pour chaque étudiant, afficher la note ou un vide si l'étudiant n'a pas cette note
          foreach ($_SESSION['etudiants'] as $etudiant):
              if (isset($etudiant->notes[$i])):
                  if($etudiant->notes[$i]<10){
                    $bgColor="rgb(193, 54, 54)";
                  }
                  elseif($etudiant->notes[$i]==10){
                    $bgColor="rgb(213, 126, 54)";
                  }
                  else{
                    $bgColor="rgb(95, 171, 89)";
                  }?>
                  <td style="background-color:<?php  echo $bgColor ?>;">
   
                  <?php echo $etudiant->notes[$i];
                  echo '</td>';
                endif;
          endforeach;
          ?>
        </tr>
      <?php endfor; ?>

      <!-- Afficher la ligne des moyennes -->
      <tr>
        <?php
        foreach ($_SESSION['etudiants'] as $etudiant):
        ?>
          <td>
            <?php
            // Afficher la moyenne de l'étudiant
            printf("Votre moyenne est %.f", $etudiant->calculMoyenne());
            ?>
          </td>
        <?php endforeach; ?>
      </tr>
    </tbody>
  </table>
</div>
