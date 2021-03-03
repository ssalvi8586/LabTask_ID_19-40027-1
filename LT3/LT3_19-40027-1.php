<?php
    include('db.php');
    $validateName="";
    $validateEmail="";
    $validateUserName="";
    $validatePassword="";
    $validateConfirmPassword="";
    $validateGender="";
    $validateDateOfBirth="";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
            $name = $_REQUEST['name'];
            $email = $_REQUEST['email'];
            $userName = $_REQUEST['userName'];
            $pass = $_REQUEST['pass'];
            $confirmPassword = $_REQUEST['confPass'];
            $gender = $_REQUEST['gender'];
            $dob = $_REQUEST['birthday'];


            if(empty($name) || strlen($name)<5){
                $validateName="Invalid Name!!! Please Enter a Valid Name";
            }
            else{
                $validateName=$name;
            }
            if(empty($email) || !preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email)){
                $validateEmail="Invalid Email!!! Please Enter a Valid Email";
            }
            else{
                $validateEmail=$email;
            }
            if(empty($userName) || !preg_match('/[a-zA-Z0-9._]{5,}$/', $userName)){
                $validateUserName="Invalid Username!!! Please enter a valid Username";
            }
            else{
                $validateUserName=$userName;
            }
            if(empty($pass) || strlen($pass)<6 || !preg_match("/(?=.*[@#$%^&+=]).*$/", $pass)){
                $validatePassword = "!!!Password must contain atleast 6 characters including atleast 1 special character!!!";
            }
            else{
                $validatePassword = "Password accepted!!!";
            }
            if(!empty($confirmPassword) && $pass == $confirmPassword){
                $validateConfirmPassword = "Correct Password!!!";
            }
            else{
                $validateConfirmPassword = "Incorrect Password!!!";
            }
            $connection = new db();
            $conobj=$connection->OpenCon();

            $userQuery=$connection->insertinfo($conobj,"registration",$name,$email,$userName,$pass,$gender,$dob);
            $connection->CloseCon($conobj);

                 
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
</head>
<body>
    <h1>Registration</h1>
    <table>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
    <tr>
        <td>Name: </td><td><input type="text" id="name" name="name"></td>
        <?php echo $validateName ?><br>
    </tr>
    <tr>
        <td>Email:</td><td> <input type="text" id="id" name="email"></td>
        <?php echo $validateEmail ?><br>
    </tr>  
    <tr>  
        <td>User Name: </td><td><input type="text" id="userName" name="userName"></td>
        <?php echo $validateUserName ?><br>
    </tr>
    <tr>  
        <td>Password:</td><td> <input type="password" id="pass" name="pass"><td> 
        <?php echo $validatePassword ?><br>
    </tr>
    <tr>  
        <td>Confirm Password:</td> <td> <input type="password" id="confPass" name="confPass"><td> 
        <?php echo $validateConfirmPassword ?><br>
    </tr>
    <tr>
    <td>Gender <br>
    <input type="radio" id="male" name="gender" value="male">
    Male
    <input type="radio" id="female" name="gender" value="female">
    Female
    <input type="radio" id="other" name="gender" value="other">
    Other</td>
    </tr>      
    <tr>
    <td>Date of Birth <br>  
    <input type="date" id="birthday" name="birthday"></td>
    </tr> 
    <tr>
    <td><input type="submit" value="SUBMIT">
    <input type="reset" value="RESET"></td>
    </tr>
    </form>
    </table>
</body>
</html>
