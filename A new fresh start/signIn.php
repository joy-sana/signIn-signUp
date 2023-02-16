<?php
$login = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include('DataBase_Connection.php');

    $Email_id = $_POST['Email_id'];
    $Username = $_POST['Username'];
    $password = $_POST['Password'];

    $stmt = $connection->Prepare("SELECT * FROM `sample` WHERE Email = ?");
    $stmt->bind_param("s", $Email_id);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {

        $data = $stmt_result->fetch_assoc();
        if ($data['Password'] === $password && $data['username'] === $Username) {
            $login = true;
           
            session_start();
            $_SESSION['loggedin'] = $login;
            $_SESSION['username'] = $Username;
            $_SESSION['email'] = $Email_id;
            $_SESSION['name'] = $data['name'];

            if (!headers_sent()) {
                header("location: welcome.php");
            }
        } else {
            $showError = "Wrong Username or Password";
    }
    } else {
        $showError = "You don't have an Account on this Email:" . "$Email_id";
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
</head>

<body>
    <div>
        <?php
        if ($showError); {
            echo $showError;
        }
        ?>
    </div>
    <h1>sign In hare</h1>
    <div>
        <table>
            <form method="POST">

                <tr>
                    <th>Email</th>
                    <td>
                        <input type="text" placeholder="Enter Email" name='Email_id' required>
                    </td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>
                        <input type="text" placeholder="Enter Username" name="Username" required>
                    </td>
                </tr>
                <tr>
                    <th>password</th>
                    <td>
                        <input type="text" placeholder="Enter your password" name='Password' required>
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" value="Sign-in" name="submit">
                    </td>
                </tr>
            </form>
        </table>
    </div>
    <div class="signup_link">
        Don't Have an Account?<a href="signUp.php">click hare to Sign Up</a>
    </div>
</body>

</html>