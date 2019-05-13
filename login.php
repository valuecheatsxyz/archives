<?php
/*
create table if not exists users (
    `ID` INT( 11 ) AUTO_INCREMENT,
    `login` varchar(60) not null,
    `senha` varchar(100) not null,
    `vipfim` varchar(100) not null,
    `hwid` varchar(200) default '',
    `plano` varchar(100) not null,
    primary key(`ID`)
);

*/
function encry($strs,$dir){
    $str = "";
    for ($i = 0; $i <= strlen($strs) -1; $i++) {
        $str = $str . chr(ord($strs[$i])+$dir);
    }
    return $str;
}

function decry($strs,$dir){
    $str = "";
    for ($i = 0; $i <= strlen($strs) -1; $i++) {
        $str = $str . chr(ord($strs[$i])-$dir);
    }
    return $str;
}
require_once("config.php");
if ($_SERVER['HTTP_ACCEPT'] > 0) {
    $login =  trim(decry(base64_decode( $_POST['login']),2));
    $senha =  trim(decry(base64_decode( $_POST['senha']),2));
    $hwid  =  trim(decry(base64_decode(  $_POST['hwid']),2));
    $versao = trim(decry(base64_decode($_POST['versao']),2));
    $sql    = "SELECT * FROM users WHERE LOWER(login)=? AND senha=?;";
    $query = $pdosql->prepare($sql);
    $query->execute(array($login,$senha));
    if($user = $query->fetch()){
        if ($user['hwid'] == ""){
            $q = $pdosql->prepare("UPDATE users SET `hwid` = ?
                WHERE `ID` = ? ;");
            $q->execute(array(md5($hwid),$user['ID']));
        }elseif ($user['hwid'] == md5($hwid)) {
            //continua de boa
        }else {
            die('hwid');
        }
        if (time() > $user['vipfim']){
            //vip acabou
            die('vipfim');
        }
        if ($versao <> $user['plano']){
            die('versao');
        }
        echo base64_encode(encry($_SERVER['HTTP_ACCEPT'],$_SERVER['HTTP_ACCEPT']));
    }

}





















 ?>
