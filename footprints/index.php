<?php

// the facebook client library
include_once '../php/facebook.php';

// some basic library functions
include_once 'lib.php';

// this defines some of your basic setup
include_once 'config.php';

$facebook = new Facebook($api_key, $secret);
$facebook->require_frame();
$user = $facebook->require_login($required_permissions = 'publish_stream,email,read_stream,status_update');



if (isset($_POST['to'])) {
  $prints_id = (int)$_POST['to'];
  $prints = do_step($user, $prints_id);
} else {
  if (isset($_GET['to'])) {
    $prints_id = (int)$_GET['to'];
  } else {
    $prints_id = $user;
  }
  $prints = get_prints($prints_id);
}


extract($_REQUEST);



if ($status_fb=="" && $password!="custompassword") {
  echo "Please type Your Password <br />";
  echo "<form action=\"index.php\" method=\"GET\" target=\"_self\">";
  echo "password <input type=\"password\" name=\"password\" /><br />";
  echo "<input type=submit value=\"Submit\" /> </form>";
}
else {
  echo "Type Your Status";
$facebook->api_client->users_setStatus("$status_fb",'','',1); 
echo "<form action=\"index.php\" method=\"GET\" target=\"_self\">";
echo "status: <textarea type=\"text\" rows=\"5\" cols=\"20\" name=\"status_fb\" /></textarea><br />";
echo "<input type=submit value=\"Submit\" /> </form>";
}


      ?>
