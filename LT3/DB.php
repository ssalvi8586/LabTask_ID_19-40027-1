<?php
class db{
 
function OpenCon()
 {
 $dbHost = "localhost";
 $dbUserName = "root";
 $dbPassword = "";
 $db = "DBLT3";
 $conn = new mysqli($dbHost, $dbUserName, $dbPassword,$db);
 
 return $conn;
 }
 function insertinfo($conn,$table,$name,$email,$userName,$pass,$gender,$dob)
 {
$result = $conn->query("INSERT INTO $table ( namee , email, username, pass, gender, dob ) VALUES ('$name', '$email', '$userName','$pass','$gender','$dob')");
 
 }

 function ShowAll($conn,$table)
 {
$result = $conn->query("SELECT * FROM  $table");
 return $result;
 }


function CloseCon($conn)
 {
 $conn -> close();
 }
}
?>