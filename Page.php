<?php
$title="Page d'accueil";
$bgStyle = "background-image: url('https://static.vecteezy.com/system/resources/previews/012/433/762/non_2x/aesthetic-colorful-pastel-floral-fluid-abstract-background-vector.jpg'); height: 100vh; background-size: cover; background-position: center;";
include_once "Session.php";
$s=new Session();
if(Session::$c!=1){ 
    $text="Merci pour votre fidélité, c'est votre " . (Session::$c) . ((Session::$c)==1 ? " ère":" ème"). " session";
}
else{
    $text="Bienvenu à notre plateforme";
}
include "header.php";

?>

<p class="hello text-break p-3 bg-light border rounded shadow-sm" style="text-align: center;"><?php echo $text; ?></p>



</body>
</html>