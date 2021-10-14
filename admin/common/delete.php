<?php
session_start();
error_reporting(0);
include('../includes/config.php');

//var_dump($dbh);
//var_dump($_POST);
if(count($_POST)>0 && $_POST['id']){
    $id=$_POST['id'];
//    $id=453262;
    $sql = "DELETE FROM user WHERE id=?";
    $stmt= $dbh->prepare($sql);
    $result = $stmt->execute([$id]);

    $sql2 = "DELETE FROM yoyaku WHERE user_id=?";
    $stmt2= $dbh->prepare($sql2);
    $result2 = $stmt2->execute([$id]);

    $sql3 = "DELETE FROM lend WHERE user_id=?";
    $stmt3= $dbh->prepare($sql3);
    $result3 = $stmt3->execute([$id]);

    if ($result && $result2 && $result3) {
        echo $id;
    }
    else {
        echo "Error: ";
    }
}