<?php

require_once("config.php");

$time       = time();
$time_check = $time-(3*300);     //15 minutos




//http://www.php-dev-zone.com/2013/07/online-users-script-using-php-and-mysql.html


if (isset($_GET['on'])){
    $sql    = "SELECT * FROM online_users WHERE session=?";
    $query = $pdosql->prepare($sql);
    $query->execute(array(trim($_GET['on'])));

    //If count is 0 , then enter the values
    if($query->rowCount() == "0"){
     $sql1    = $pdosql->prepare("INSERT INTO online_users (session, time)VALUES(?, ?)");
     $sql1->execute(array(trim($_GET['on']),$time));
    } else {
     $sql2    = $pdosql->prepare("UPDATE online_users SET time='?' WHERE session = '?'");
     $sql2->execute(array($time,trim($_GET['on'])));
    }
}

 $sql3  = $pdosql->prepare("SELECT * FROM online_users");
 $sql3->execute();
 $count_user_online = $sql3->rowCount();
 echo "$count_user_online";

 // after 5 minutes, session will be deleted
 $sql4    = $pdosql->prepare("DELETE FROM online_users WHERE time<?");
 $sql4->execute(array($time_check));


 ?>
