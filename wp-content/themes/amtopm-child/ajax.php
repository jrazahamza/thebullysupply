<?php

include ('connection.php');
$vendor=$_POST['id'];
$customer=$_POST['senderid'];
$chats=mysqli_query($con," SELECT * FROM `chat` WHERE `customer`='".$customer."' and `vendor`='".$vendor."' ");      
$chat = mysqli_fetch_array($chats);
$chats2=mysqli_query($con," SELECT * FROM `chat` WHERE `vendor`='".$customer."' and `customer`='".$vendor."' ");      
$chat2 = mysqli_fetch_array($chats2);
if($chat['id'] || $chat2['id']){
    
}else{
    mysqli_query($con," INSERT INTO `chat`(`customer`, `vendor`) VALUES ('".$customer."','".$vendor."') ");
}
