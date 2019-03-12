<?php
  session_start();
  require_once("config.php");
  require_once("template.php");
  //verbinden dateabase
  $mysqli = new mysqli($config["dbhost"], $config["dbusername"],
  $config["dbpassword"], $config["dbname"]);
  if ($mysqli->connect_errno) {
    die("Er is geen verbinding mogelijk!");
  }

  $template = new Template();
  $action = @$_GET["action"];
  if(($action == "login") && ($_POST["Verzenden"] == "Verzenden")){
    //controle
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);
    $query = "SELECT * FROM `user` WHERE `username`='".$username."'
    AND `password` = '".$password"'";
    if ($result = $myspli->query($query)) {
      if ($result->num_rows == 1) {
        //geldige gebruiker
        $_SESSION["login"] = true;
        $_SESSION["user"] = $result->fetch_assoc();
      }
    }
    else{
      die("Probleem met database");
    }
  }

  if ($_SESSION["login"]) {
    $val= array();
    $val["NAME"] = $_SESSION["user"]["name"];
    echo $template->generateTemplate("loginok",$val);
  }
  else{
    echo $template->generateTemplate("login");
  }

?>
