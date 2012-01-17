<?php
require_once('util/facebook.php');


// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '153053701464197',
  'secret' => '9faf86161ca03fd7a3def4c105a2c3c1',
));

// Get User ID
$user = $facebook->getUser();


?>





<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>..::Rumbo y los 100.000..::</title>
    </head>
    <body>
       
        <?php
        
        if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}

// This call will always work since we are fetching public data.
$naitik = $facebook->api('/naitik');
        
        ?>
        
 <!-- ******************************************************************************************************** -->      
         <?php 
         if ($user)
         {
         ?>
      <a href="<?php echo $logoutUrl; ?>">Salir</a>
      <br>
      
      <h3>Hola <?php echo $user_profile["name"]; ?></h3>
      <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

     
      
    <?php }
         else
        { ?>
      <div>
        
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      </div>
        <?php 
          }
         
     //print_r($_SESSION);
   
   
   ?>
      <hr>
    
    </body>
    
    
    
</html>
