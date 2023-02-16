
<?php

$showalert=false;



// create a connection with database
include('DataBase_Connection.php');


if (isset($_POST['SignUp'])) {

    $fullName = $_POST['fullName'];
    $Email_id = $_POST['Email_id'];
    $Username = $_POST['Username'];
    $phone = $_POST['phoneNumber'];
    $password = $_POST['Password']; 
    $con_password = $_POST['C_Password'];

    if ($password == $con_password){
        //chechks phone number is unique or not
        $statement = $connection->Prepare("SELECT * FROM `sample` WHERE Email = ?");
        
        $statement->bind_param("s", $Email_id);
        $statement->execute();
        $statement_result = $statement->get_result();
        
        //if number is not uniqe throws a alart
        if ($statement_result->num_rows > 0) {
            $showalert="Warning: Email Already Exists!!!";
        }
        //else data inserted into database
        else{
            $sql_insert = "INSERT INTO sample(name,email,username,phone,Password)VALUES('$fullName','$Email_id','$Username','$phone','$password')";
            $query = mysqli_query($connection, $sql_insert);
        }
    }
    else{
        $showalert=  "Warning: Password is not matchning";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src = "js\showpass.js"></script>
</head>

<body>

    <div>
        <?php 
        if ($showalert) {
            echo $showalert;
        }
        ?>
    </div>
    
    <h1>sign up page</h1>
    <div>
        <table>
        <form method="POST">
        <!-- <form action="signUp.php" method="POST"> -->
                <tr>
                    <th>Full Name</th>
                    <td>
                        <input type="text" placeholder="Enter Your Name" name='fullName' required>
                    </td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>
                        <input type="text" placeholder="Create Username" name="Username" required>
                    </td>
                </tr>
                <tr>
                    <th>Mobile Number</th>
                    <td>
                        <input type="text" placeholder="Enter Mobile number" name='phoneNumber' required>
                    </td>
                </tr>                
                <tr>
                    <th>Email</th>
                    <td>
                        <input type="text" placeholder="Enter Email" name='Email_id' required>
                    </td>
                </tr>                
                <tr>
                    <th>Password</th>
                    <td>
                        <input type="password" placeholder="Enter a secure password" name='Password' id="myInput" required>
                        <input type="checkbox" onclick="myFunction('myInput')">Show Password

                    </td>
                </tr>
                <tr>
                    <th>Confirm Password</th>
                    <td>
                        <input type="password" placeholder="Re-Enter password" name='C_Password' id="myInput2" required>
                        <input type="checkbox" onclick="myFunction('myInput2')">Show Password
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <input type="submit" name='SignUp' required>
                    </td>
                </tr>
            </form>
        </table>
    </div>
    <div class="signup_link">
    Already Have an Account?<a href="signin.php">click hare to Sign-in</a>
</div>
</body>

</html>

