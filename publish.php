<?php
require_once('index.php');
 session_start();

/*
          if( $loggedIn){

    // Logged in
              $_SESSION['fb_token'] = $session->getToken();
       if (isset($_POST["text"])) {


        $publish = (new FacebookRequest(
            $session, 'POST', '/me/feed/',
            array (

              'message' => $text
              )));
        $publish=$publish->execute();
        header("Location: index.php");

    }else{
      console.log("failed");
    }

}
console.log("dasd");


 ?>
