<?php
include('../model/db.php');


 $error="";

if (isset($_POST['update'])) {
if (empty($_POST['firstname']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['address'])) {
$error = "input given is invalid";
}
else
{
$connection = new db();
$conobj=$connection->OpenCon();

$interestItem1=$interestItem2=$interestItem3=$interestItem4=" ";
if(!empty($_POST['interest1'])){
    $interestItem1=$_POST['interest1'];
}
if(!empty($_POST['interest2'])){
    $interestItem2=$_POST['interest2'];
}
if(!empty($_POST['interest3'])){
    $interestItem3=$_POST['interest3'];
}
if(!empty($_POST['interest4'])){
    $interestItem4=$_POST['interest4'];
}

$interests = "$interestItem1"."+"."$interestItem2"."+"."$interestItem3"."+"."$interestItem4";

$userQuery=$connection->UpdateUser($conobj,"student",$_SESSION["username"],$_POST['firstname'],$_POST['email'],$_POST['password'], $_POST['address'], $_POST['dob'], $_POST['gender'], $_POST['profession'], $interests);
if($userQuery==TRUE)
{
    echo "update successful"; 
}
else
{
    echo "could not update";    
}
$connection->CloseCon($conobj);

}
}


?>
