<html>
<head>
<title>Trying a facebook app</title>
</head>
<body>
<h1>Who Am I? </h1> 
<?php

//the next 4 lines will bring the Facebook SDK in to your program and initialize it
       require ("facebook.php");
       define("FACEBOOK_APP_ID", '439943216110708');
       define("FACEBOOK_SECRET_KEY", '57aa62b936da569119caeae35d9ed72b');
       $facebook = new Facebook(array('appId' => FACEBOOK_APP_ID, 'secret' => FACEBOOK_SECRET_KEY));
       $uid = $facebook->getUser();
       if (!$uid)
              {$loginUrl = $facebook->getLoginUrl();
              echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
              exit;
       }

       try {$uid = $facebook->getUser();
              print $uid; //this is the unique number that identifies a facebook user
              $user_profile = $facebook->api('/me','GET');
              echo "<br>First Name: " . $user_profile['first_name'];
              $profilepic= "https://graph.facebook.com/" . $user_profile['id'] ."/picture?type=large";
              echo "<p>URL Location of my facebook profile picture: " ;
              echo $profilepic; 
              $headers = get_headers ($profilepic, 1);
              $url = $headers['Location'];
              echo "<p>URL location of my facebook profile picture if I need to get at the .jpg file:";
              echo $url;
              echo "<img src=\" $profilepic \"/>";
              echo "<p>";
              $friends = $facebook->api('/me/friends',array('fields' => 'id,name')); 
              echo '<ul>';
              foreach ($friends["data"] as $value) {
                            echo '<li>';
                            echo '<div class="picName">'.$value["name"].'</div>';
                            echo '</li>';
              }
              echo '</ul>'; 
        } catch (FacebookApiException $e) {
              print "in error exception";
              echo ($e);
        }
?>
</body>
</html>