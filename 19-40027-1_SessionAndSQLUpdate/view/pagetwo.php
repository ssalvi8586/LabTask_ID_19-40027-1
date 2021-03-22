<?php
session_start(); 

include('../control/updatecheck.php');


if(empty($_SESSION["username"])) // Destroying All Sessions
{
header("Location: ../control/login.php"); // Redirecting To Home Page
}

?>

<!DOCTYPE html>
<html>
<body>
<h2>Profile Page</h2>

Hii, <h3><?php echo $_SESSION["username"];?></h3>
<br>Your Profile Page.
<br><br>
<?php
$radio1=$radio2=$radio3="";
$firstname=$email=$password=$address="";
$connection = new db();
$conobj=$connection->OpenCon();

$userQuery=$connection->CheckUser($conobj,"student",$_SESSION["username"],$_SESSION["password"]);

if ($userQuery->num_rows > 0) {

    // output data of each row
    while($row = $userQuery->fetch_assoc()) {
      $firstname=$row["firstname"];
      $email=$row["email"];
      $password=$row["password"];
      $address=$row["address"];
      $dob=$row["dob"];
      $profession=$row["profession"];
      $interests=$row["interests"]; 
      $item = "";
      $pattern="/[+]/";
      $item = preg_split($pattern,$interests);

      if( $row["gender"]=="female" )
      { $radio1="checked"; }
      else if($row["gender"]=="male")
      { $radio2="checked"; }
      else{$radio3="checked";}

      $checkbox1=$checkbox2=$checkbox3=$checkbox4="";
      if($item[0]=='reading'|| $item[1]=='reading' || $item[2]=='reading' || $item[3]=='reading')
      {
        $checkbox1 = "checked";
      }
      if($item[0]=='sports'|| $item[1]=='sports' || $item[2]=='sports' || $item[3]=='sports')
      {
        $checkbox2 = "checked";
      }
      if($item[0]=='travelling'|| $item[1]=='travelling' || $item[2]=='travelling' || $item[3]=='travelling')
      {
        $checkbox3 = "checked";
      }
      if($item[0]=='music'|| $item[1]=='music' || $item[2]=='music' || $item[3]=='music')
      {
        $checkbox4 = "checked";
      }

      $option1=$option2=$option3=$option4="";
      
      if($profession=="Academician" )
      { $option1="selected"; }
      else if($profession=="Engineer")
      { $option2="selected"; }
      else if($profession=="Doctor")
      { $option3="selected"; }
      else if($profession=="Teacher")
      { $option4="selected"; }
   
  } 
}
  else {
    echo "0 results";
  }



?>
<form action='' method='post'>
firstname : <input type='text' name='firstname' value="<?php echo $firstname; ?>" >

email : <input type='text' name='email' value="<?php echo $email; ?>" ><br>
Password : <input type="password" name="password" value="<?php echo $password; ?>" ><br>
Address : <input type='text' name='address' value="<?php echo $address; ?>" >
<br>
 Gender:
     <input type='radio' name='gender' value='female'<?php echo $radio1; ?>>Female
     <input type='radio' name='gender' value='male' <?php echo $radio2; ?> >Male
     <input type='radio' name='gender' value='other'<?php  $radio3; ?> > Other
     <br>

     Date : <input type='date' name='dob' value="<?php echo $dob; ?>">

     Professsion : 
     <select name="profession">
        <option value="Academician" <?php echo $option1;?>>Academician</option>
        <option value="Engineer" <?php echo $option2;?>>Engineer</option>
        <option value="Doctor" <?php echo $option3;?>>Doctor</option>
        <option value="Teacher" <?php echo $option4;?>>Teacher</option>
      </select> 
      <br>

      <label for="interest">Interest: </label>
      <input type="checkbox" name="interest1" value='reading' <?php echo $checkbox1; ?>>
      <label for="interest1">Reading</label>
      <input type="checkbox" name="interest2" value='sports' <?php echo $checkbox2; ?>>
      <label for="interest2">Sports</label>
      <input type="checkbox" name="interest3" value='travelling' <?php echo $checkbox3; ?>>
      <label for="interest3">Travelling</label>
      <input type="checkbox" name="interest4" value='music' <?php echo $checkbox4; ?>>
      <label for="interest4">Music</label>
      
<br>
     <input name='update' type='submit' value='Update'>  

     <?php echo $error; ?>
<br>
<br>
<a href="../view/pageone.php">Back </a>

<a href="../control/logout.php"> logout</a>

</body>
</html>