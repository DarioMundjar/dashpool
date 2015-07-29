    <?php
    require_once('config.php');
    use Facebook\FacebookSession;
    use Facebook\FacebookRedirectLoginHelper;
    use Facebook\FacebookRequest;
    use Facebook\FacebookResponse;
    use Facebook\FacebookSDKException;
    use Facebook\FacebookRequestException;
    use Facebook\FacebookAuthorizationException;
    use Facebook\GraphObject;
    use Facebook\HttpClients\FacebookCurl;
    use Facebook\HttpClients\FacebookHttpable;
    use Facebook\HttpClients\FacebookCurlHttpClient;
    use Facebook\Entities\AccessToken;
    use Facebook\GraphUser;
    use Facebook\GraphSessionInfo;
    // init app with app id (APPID) and secret (SECRET)
    FacebookSession::setDefaultApplication('780144152078084','b5919db092fc187fde29dbb6593983fe');
    // login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper( 'http://localhost/dashpool/twitteroauth-master/index.php' );
    session_start();

    if (isset($_SESSION['fb_token'])) {
    // use a saved access token - will get to this later
        $session = new FacebookSession($_SESSION['fb_token']);
        try {
            if (!$session->validate()) {
                $session = null;
            }
        }
        catch (Exception $e) { $session = null; }
    } else {
        try {
            $session = $helper->getSessionFromRedirect();
        }
        catch(FacebookRequestException $ex) { }
        catch(\Exception $ex) { }
    }

    $loggedIn = false;
    // see if we have a session
    if (isset($session)){
        if ($session) {
            $loggedIn = true;
            try {
    // Logged in
              $_SESSION['fb_token'] = $session->getToken();

    /*
    --------
    Profile feed
    --------
    */

    $page_feed = (new FacebookRequest(
        $session, 'GET', '/me/feed/'
        ))->execute()->getGraphObject(GraphUser::className());
    $page_feed = $page_feed->asArray();
    $array = json_decode(json_encode($page_feed), true);
    //print_r($array);

    /*
    --------
    Home feed
    --------
    */
    $home = (new FacebookRequest(
        $session, 'GET', '/me/home/'
        ))->execute()->getGraphObject(GraphUser::className());
    $home = $home->asArray();
    $home = json_decode(json_encode($home), true);
    //print_r($home);


    /*
    --------
    Photos from profile
    --------
    */
    $photos = (new FacebookRequest(
        $session, 'GET', '/me/photos/'
        ))->execute()->getGraphObject(GraphUser::className());
    $photos = $photos->asArray();
    $photos = json_decode(json_encode($photos), true);
    //print_r($photos);





    //print_r($photos);

    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">

      <title></title>

      <!-- Bootstrap Core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">


      <link rel="stylesheet" type="text/css" href="css/component.css" />
      <!-- Custom CSS -->
      <link href="css/scrolling-nav.css" rel="stylesheet">

      <link rel="stylesheet" href="css/magnific-popup.css">
      <link rel="stylesheet" href="css/menu_slide.css">

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    	    <!--[if lt IE 9]>
    	        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
               <![endif]-->

             <script src="js/jquery.js"></script>

               <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>

               <!-- Bootstrap Core JavaScript -->
               <script src="js/bootstrap.min.js"></script>

               <script src="js/jquery.magnific-popup.js"></script>

               <script type="text/javascript" src="js/main.js"></script>
               <script src="js/jquery.easing.min.js"></script>
               <script src="js/scrolling-nav.js"></script>

               <script src="lib/sweet-alert.min.js"></script>
               <link rel="stylesheet" href="lib/sweet-alert.css">

                <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
                  <link rel="stylesheet" href="css/menu_sideslide.css">
    </head>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container">
                    <div class="navbar-header page-scroll">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand page-scroll" href="#page-top">
                            <img src="img/logo.png" alt="">
                        </a>
                        <a class="navbar-brand page-scroll" href="#page-top">DashPool
                        </a>

                    </div>

                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav">

                            <li class="hidden">
                                <a class="page-scroll" href="#page-top"></a>
                            </li>
                            <li>

                            </li>
                            <li>

                            </li>
                            <li>

                            </li>

                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <div id="morphsearch" class="morphsearch">
                                <form action="index.php" method="post" class="morphsearch-form" >
                                  <input class="morphsearch-input" type="search" placeholder="Search..." name="keyword"/>
                                  <button class="morphsearch-submit" type="submit">Search</button>
                              </form>

                              <span class="morphsearch-close"></span>
                          </div>

                          <div class="overlay"></div>
                      </div>

                  </div>

              </nav>
           <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
            <div class="menu-wrap">
            <nav class="menu">
          <div class="icon-list">
            <a href="#"><i class="fa fa-fw fa-star-o"></i><span>Favorites</span></a>
            <a href="#"><i class="fa fa-fw fa-bell-o"></i><span>Alerts</span></a>
            <a href="#"><i class="fa fa-fw fa-envelope-o"></i><span>Messages</span></a>
            <a href="#"><i class="fa fa-fw fa-comment-o"></i><span>Comments</span></a>
            <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i><span>Analytics</span></a>
            <a href="#"><i class="fa fa-fw fa-newspaper-o"></i><span>Logout</span></a>
          </div>
        </nav>

        <button class="close-button" id="close-button">Close Menu</button>
    </div>
      <button class="menu-button" id="open-button">Open Menu</button>
           
              <div class="content-wrap">
              <section id="publish" class="publish">
               <form action="index.php" method="post" >
                  <input  type="search" placeholder="Search..." name="keyword"/>
                  <button type="submit">Search</button>
              </form>
              <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                      <h4>Share your thoughts</h4>

                      <form name="form2" id="form2" method="post" action="index.php" onsubmit="return validate(); return false;">
                        <textarea placeholder="Write something..." id="content" name="textval"></textarea>

                        <div id="button_block">
                            <input type="submit" class="btn btn-primary" id="publish" value="publish " name="publish" />
                            <input type="submit" class="btn btn-danger"id='cancel' value=" Cancel" />


                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <form name="form3"  method='POST' action="index.php">
      <input type="hidden" name="text" id="text" />
      <input type="submit" id="button" value="buttton">
        </form>
    <section id="twitter" class="twitter-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ui-state-hover ui-state-default" id="dropzone0">

                  <i class="fa fa-twitter fa-2x"></i>
<div class="tw-posts">
                 <?php
    /*
    --------
    Tweets from timeline
    --------
    */
    $j=0;
    $post=$twitter->post('https://api.twitter.com/1.1/statuses/update.json?status=');
    foreach($timeline as $tweet){
                //tw update div for posts
     echo "<div class=\"tw-update\" id='draggabletw$j'>";
     echo "<div class='post-container2'>";
     echo "<div class='post-thumb2'><img src=".$tweet->user->profile_image_url." /> <br> </div>";
     echo "<div class='post-content2'><p>".$tweet->user->name." </p>";
     echo "</div>";
     echo "</div>";
     echo "<br/>";
     echo "<br/>";
     echo "<br/>";
     echo "<p class='tweet'>".$tweet->text."</p><br>";
     $j++;
     echo "</div>";

     if ($j == 15) {
         break;
     }
    }
    ?>

    <h1>Home</h1>
    <?php
    foreach($status as $tweet){
                  //tw update div for posts
       echo "<div class=\"tw-update\">";
       echo "<div class='post-container2'>";
       echo "<div class='post-thumb2'><img src=".$tweet->user->profile_image_url." /> <br> </div>";
       echo "<div class='post-content2'><p>".$tweet->user->name." </p>";
       echo "</div>";
       echo "</div>";
       echo "<br/>";
       echo "<br/>";
       echo "<br/>";
       echo "<p class='tweet'>".$tweet->text."</p><br>";
       echo "</div>";

    }
    ?>
    <?php

     /*
    --------
    Search public tweets
    --------
    */
    if(isset($_POST['keyword'])) {
     $tweets=$twitter2->get('https://api.twitter.com/1.1/search/tweets.json?q='.$_POST['keyword'].'&result_type=recent&count=10');
     foreach($tweets->statuses as $tweet){

         echo '<img src="'.$tweet->user->profile_image_url.'" /> '.$tweet->text.'<br>';
     }
    }
    ?>
    </div>
  </div>
    <div class="col-md-6" id="dropzone1">
      <i class="fa fa-facebook-official  fa-2x"></i>
      <?php
      $i=0;
      echo '<br>';

    /*
    --------
    Publishing post for tw and fb
    --------
    */
    echo "<p>".$message."</p>";
    $text="";
   if (isset($_POST["publish"])) {

        $text=$_POST['textval'];
        $publish = (new FacebookRequest(
            $session, 'POST', '/me/feed/',
            array (

              'message' => $text
              )));
        $publish=$publish->execute();
        header("Location: index.php");
    }else{

    }
    if(strlen($text) <= 140){
       $post=$twitter->post('https://api.twitter.com/1.1/statuses/update.json?status='.$text);
    }
    else {
     //echo $message="Message to long for tweet!";
    }
    if (isset($_POST["text"])) {

      $text2=$_POST['text'];
     $publish = (new FacebookRequest(
         $session, 'POST', '/me/feed/',
         array (

           'message' => $text2
           )));
     $publish=$publish->execute();
     header("Location: index.php");

 }else{

 }

    /*
    --------
    Person search fb
    --------
    */
 /*   if(isset($_POST['keyword'])) {
        $person_search = (new FacebookRequest(
            $session, 'GET', '/search?q='.$_POST['keyword'].'&type=user'
            ))->execute()->getGraphObject(GraphUser::className());
        $person_search = $person_search->asArray();
        $person_search = json_decode(json_encode($person_search), true);
       // print_r($person_search);
    }
 if(!empty($person_search)){
   foreach ($person_search['data'] as $person){
       // echo $person['name'];
        $name=$person['name'];
        $idp=$person['id'];
        echo "<img class='profile' src=http://graph.facebook.com/".$idp."/picture?type=square /> </div>";
        echo '<a href="https://www.facebook.com/"'.$idp.'>'.$name.'</a>';
        echo '<br>';
    }
}
    /*
    --------
    Event search fb
    --------
    */
    if(isset($_POST['keyword'])) {
        $event_search = (new FacebookRequest(
            $session, 'GET', '/search?q='.$_POST['keyword'].'&type=event'
            ))->execute()->getGraphObject(GraphUser::className());
        $event_search = $event_search->asArray();
        $event_search = json_decode(json_encode($event_search), true);
        //print_r($event_search);
    if(!empty($event_search)){

   foreach ($event_search['data'] as $event){


    }
}
    }

    /*
    --------
    Group search fb
    --------
    */
    if(isset($_POST['keyword'])) {
        $group_search = (new FacebookRequest(
            $session, 'GET', '/search?q='.$_POST['keyword'].'&type=group'
            ))->execute()->getGraphObject(GraphUser::className());
        $group_search = $group_search->asArray();
        $group_search = json_decode(json_encode($group_search), true);
      // print_r($group_search);
 if(!empty($group_search)){
   foreach ($group_search['data'] as $group){
    }
}
    }
    /*
    --------
    Place search fb
    --------
    */
    if(isset($_POST['keyword'])) {
        $place_search = (new FacebookRequest(
            $session, 'GET', '/search?q='.$_POST['keyword'].'&type=place'
            ))->execute()->getGraphObject(GraphUser::className());
        $place_search = $place_search->asArray();
        $place_search = json_decode(json_encode($place_search), true);
       // print_r($place_search);

 if(!empty($place_search)){
   foreach ($place_search['data'] as $place){


    }
}
    }

     /*
    --------
    Public page search fb
    --------
    */
    if(isset($_POST['keyword'])) {
        $page_search = (new FacebookRequest(
            $session, 'GET', '/search?q='.$_POST['keyword'].'&type=page'
            ))->execute()->getGraphObject(GraphUser::className());
        $page_search = $page_search->asArray();
        $page_search = json_decode(json_encode($page_search), true);
       // print_r($page_search);

         if(!empty($page_search)){
   foreach ($page_search['data'] as $page){


    }
}
    }

    /*
    --------
    Print post from timeline, going through as array and checking type
    --------
    */
    function timeline($data){
      $i=0;
      foreach($data['data'] as $post) {

          if ($post['type'] == 'status' || $post['type'] == 'link' || $post['type'] == 'photo') {
              // fb posts

              echo "<div class=\"fb-update\" id='draggable$i'>";
              $idp=$post['from']['id'];
              $name=$post['from']['name'];
            //  $comments=$post['comments']['from'];
              $like_count=0;
              $likes=null;
              if(isset($post['likes']['data'])){
              $likes=$post['likes']['data'];

              foreach($likes as $like){
                  $likename=$like['name'];
                  $like_count++;
                 // echo $likename;
              }
            }
              echo "<div class='post-container'>";
              echo "<div class='post-thumb'><img class='profile' src=http://graph.facebook.com/".$idp."/picture?type=square /> </div>";
              echo "<div class='post-content'><p>".$name." </p>";
              echo "<p class='time'>". date("jS M, Y", (strtotime($post['created_time']))) . "</p>";
              echo "</div>";
              echo "</div>";
              echo "<br>";
              echo "<br>";
              echo "<br>";
             echo $i;
              echo "<div id='contenttext$i'>";

              if ($post['type'] == 'status') {
                  if (empty($post['story']) === false) {
                      echo "<p>" . $post['story'] . "</p>";
                  } elseif (empty($post['message']) === false) {
                      echo "<p>" . $post['message'] . "</p>";
                  }
              }
              echo "</div>";

              if ($post['type'] == 'link') {
                  echo "<p><a href=\"" . $post['link'] . "\" target=\"_blank\">" . $post['link'] . "</a></p>";
              }
              if ($post['type'] == 'photo') {
                  if (empty($post['story']) === false) {
                      echo "<p>" . $post['story'] . "</p>";
                  } elseif (empty($post['message']) === false) {
                      echo "<p>" . $post['message'] . "</p>";
                  }
                      //echo "<p><a href=\"" . $post[https://graph.facebook.com/'link'] . "\" target=\"_blank\">View photo &rarr;</a></p>";
                  $url=$post['picture'];
                  echo '<a href="' . $post['link'] .' "\" target=\"_blank\"><div><img src= "'. $url.'"/picture?type=large/></a></div>';
                                  ///echo "<img src=".$post['picture'];"/>";
                                 //$uid=$post['id'];
                                 // $pic =  "http://graph.facebook.com/".$uid."/picture";
                               // echo "<img src=\"".$pic."\" />";
              }
                          echo '<img src="img/like.png" />';

                          echo $like_count;

                          echo "</div>"; // close fb-update div

                          echo "<br>";

                          $i++; // add 1 to the counter if our condition for $post['type'] is met
                      }

                      //  break out of the loop if counter has reached 15
                      if ($i == 15) {
                          break;
                      }
                  }
    }
    timeline($array);
  //  timeline($home);
/*    foreach($array['data'] as $post) {
        if ($post['type'] == 'status' || $post['type'] == 'link' || $post['type'] == 'photo') {
            // fb posts

            echo "<div class=\"fb-update\" id='draggable$i'>";
            $idp=$post['from']['id'];
            $name=$post['from']['name'];
          //  $comments=$post['comments']['from'];
            $like_count=0;
            $likes=null;
            if(isset($post['likes']['data'])){
            $likes=$post['likes']['data'];

            foreach($likes as $like){
                $likename=$like['name'];
                $like_count++;
               // echo $likename;
            }
          }
            echo "<div class='post-container'>";
            echo "<div class='post-thumb'><img class='profile' src=http://graph.facebook.com/".$idp."/picture?type=square /> </div>";
            echo "<div class='post-content'><p>".$name." </p>";
            echo "<p class='time'>". date("jS M, Y", (strtotime($post['created_time']))) . "</p>";
            echo "</div>";
            echo "</div>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
           echo $i;
            echo "<div id='contenttext$i'>";

            if ($post['type'] == 'status') {
                if (empty($post['story']) === false) {
                    echo "<p>" . $post['story'] . "</p>";
                } elseif (empty($post['message']) === false) {
                    echo "<p>" . $post['message'] . "</p>";
                }
            }
            echo "</div>";

            if ($post['type'] == 'link') {
                echo "<p><a href=\"" . $post['link'] . "\" target=\"_blank\">" . $post['link'] . "</a></p>";
            }
            if ($post['type'] == 'photo') {
                if (empty($post['story']) === false) {
                    echo "<p>" . $post['story'] . "</p>";
                } elseif (empty($post['message']) === false) {
                    echo "<p>" . $post['message'] . "</p>";
                }
                    //echo "<p><a href=\"" . $post[https://graph.facebook.com/'link'] . "\" target=\"_blank\">View photo &rarr;</a></p>";
                $url=$post['picture'];
                echo '<a href="' . $post['link'] .' "\" target=\"_blank\"><div><img src= "'. $url.'"/picture?type=large/></a></div>';
                                ///echo "<img src=".$post['picture'];"/>";
                               //$uid=$post['id'];
                               // $pic =  "http://graph.facebook.com/".$uid."/picture";
                             // echo "<img src=\"".$pic."\" />";
            }
                        echo '<img src="img/like.png" />';

                        echo $like_count;

                        echo "</div>"; // close fb-update div

                        echo "<br>";

                        $i++; // add 1 to the counter if our condition for $post['type'] is met
                    }

                    //  break out of the loop if counter has reached 15
                    if ($i == 15) {
                        break;
                    }
                } // end the foreach statement
                */
                /*
                foreach($home['data'] as $post) {
                    if ($post['type'] == 'status' || $post['type'] == 'link' || $post['type'] == 'photo') {
                        // open up an fb-update div
                        echo "<div class=\"fb-update\">";
                        // post the time
                        $idp=$post['from']['id'];
                        $name=$post['from']['name'];
                        echo "<div class='post-container'>";
                        echo "<div class='post-thumb'><img class='profile' src=http://graph.facebook.com/".$idp."/picture?type=square /> </div>";
                        echo "<div class='post-content'><p>".$name." </p>";
                        echo "<p class='time'>". date("jS M, Y", (strtotime($post['created_time']))) . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "<br>";
                        echo "<br>";
                        echo "<br>";
                        // check if post type is a status
                        if ($post['type'] == 'status') {
                            if (empty($post['story']) === false) {
                                echo "<p>" . $post['story'] . "</p>";
                            } elseif (empty($post['message']) === false) {
                                echo "<p>" . $post['message'] . "</p>";
                            }
                        }
                            // check if post type is a link
                        if ($post['type'] == 'link') {
                               // echo "<p>" . $post['name'] . "</p>";
                            echo "<p><a href=\"" . $post['link'] . "\" target=\"_blank\">" . $post['link'] . "</a></p>";
                        }
                            // check if post type is a photo
                        if ($post['type'] == 'photo') {
                            if (empty($post['story']) === false) {
                                echo "<p>" . $post['story'] . "</p>";
                            } elseif (empty($post['message']) === false) {
                                echo "<p>" . $post['message'] . "</p>";
                            }
                               //echo "<p><a href=\"" . $post[https://graph.facebook.com/'link'] . "\" target=\"_blank\">View photo &rarr;</a></p>";
                            $url=$post['picture'];
                            echo '<a href="' . $post['link'] .' "\" target=\"_blank\"><div><img src= "'. $url.'"/picture?type=large/></a></div>';

                                ///echo "<img src=".$post['picture'];"/>";
                               //$uid=$post['id'];
                               // $pic =  "http://graph.facebook.com/".$uid."/picture";
                             // echo "<img src=\"".$pic."\" />";
                        }
                       echo "</div>"; // close fb-update div
                        $i++; // add 1 to the counter if our condition for $post['type'] is met
                    }
                    //  break out of the loop if counter has reached 10
                    if ($i == 15) {
                        break;
                    }
                } // end the foreach statement
                */
                foreach($photos['data'] as $post) {
                    $url=$post['source'];
                    $wid=$post['width'];
                    $hei=$post['height'];

                    $width=$wid*0.5;
                    $height=$hei*0.5;

                    echo '<script language="text/javascript">photo('.$url.','.$i.');</script>';
                    echo "<img  class='popup1' src='$url' width='".$width."' height='".$height."'/>";
                    echo "<hr class='fbhr'>";
                    $i++;
                    //  break out of the loop if counter has reached 10
                    if ($i == 15) {
                        break;
                    }
                }
                 // end the foreach statement
    /*pic = $user_photos["data"][0]->{"source"};
    print_r($user_photos);
    echo "<img src='$pic' />";*/
    } catch(FacebookRequestException $e) {
        echo "Exception occured, code: " . $e->getCode();
        echo " with message: " . $e->getMessage();
    }
    }
    }
    if (!$loggedIn){
        $loginUrl = $helper->getLoginUrl(["public_profile", "publish_actions", "user_photos","user_status","read_stream"]);
        echo "<a href='$loginUrl'>Login";
    } else {

    }
    ?>
    </div>
    </div>


    </section>
  </div>
    <script type="text/javascript">



     // console.log(photo);


     function myFunction() {

        console.log("sdfsd");
    }
    $(document).ready(function() {
      function photo(url,i){
        var phot=url;
      //  var photo= "<?php echo $url; ?>";
      console.log(url);
      $('.popup'+i).magnificPopup({
        items: {
          src: url
      },
        type: 'image' // this is default type
    });
    }


    });




    </script>
    <script src="js/classie.js"></script>
     <script src="js/menu.js"></script>
    <script>
    function validate() {

        submitFlag = true;
        if(document.form2.textval.value.length>140){
            submitFlag=true;


            swal({
              title: "Oops!",
              text: "Message is too long for Twitter.",
              imageUrl: "img/twitter.png"
          });
        }
        return submitFlag;
    }
    (function() {
        var morphSearch = document.getElementById( 'morphsearch' ),
        input = morphSearch.querySelector( 'input.morphsearch-input' ),
        ctrlClose = morphSearch.querySelector( 'span.morphsearch-close' ),
        isOpen = isAnimating = false,
              // show/hide search area
              toggleSearch = function(evt) {
                // return if open and the input gets focused
                if( evt.type.toLowerCase() === 'focus' && isOpen ) return false;

                var offsets = morphsearch.getBoundingClientRect();
                if( isOpen ) {
                  classie.remove( morphSearch, 'open' );

                  // trick to hide input text once the search overlay closes
                  // todo: hardcoded times, should be done after transition ends
                  if( input.value !== '' ) {
                    setTimeout(function() {
                      classie.add( morphSearch, 'hideInput' );
                      setTimeout(function() {
                        classie.remove( morphSearch, 'hideInput' );
                        input.value = '';
                    }, 300 );
                  }, 500);
                }

                input.blur();
            }
            else {
              classie.add( morphSearch, 'open' );
          }
          isOpen = !isOpen;
      };

            // events
            input.addEventListener( 'focus', toggleSearch );
            ctrlClose.addEventListener( 'click', toggleSearch );
            // esc key closes search overlay
            // keyboard navigation events
            document.addEventListener( 'keydown', function( ev ) {
              var keyCode = ev.keyCode || ev.which;
              if( keyCode === 27 && isOpen ) {
                toggleSearch(ev);
            }
        } );

            /***** for demo purposes only: don't allow to submit the form *****/
            morphSearch.querySelector( 'button[type="submit"]' ).addEventListener( 'click', function(ev) { ev.preventDefault(); } );
        })();
        </script>
    </body>
    </html>
