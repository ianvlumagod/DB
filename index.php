<?php
require_once('config.php');

$username = "";
$password = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT username, password FROM user WHERE username = ?";

    if($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $param_username);

        $param_username = trim($username);

        echo "<script> console.log(" . $username . "); </script>";

        if(mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $use, $pass);
                if(mysqli_stmt_fetch($stmt)) {
                    if(trim($password) == $pass) {
                        echo "SUCCESS";
                        // header("location: index.html");
                        header("location: movies.html");
                    }
                    else {
                        echo "<script> alert('Incorrect Password'); </script>";
                    }
                }
            }
            else {
                echo "<script> console.log(" . $username . "); </script>";
                // echo "<script> alert('Invalid Username'); </script>";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Robinsons Movieworld</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="index.css" />
    <script src="main.js"></script>
</head>
<body>
    <div class="boxHolder">
        <img src="img/logo.jpg" alt="" style="opacity: 1;" class="logo">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <label for="username">Username</label>
            <input type="text" name="username">
            <br>
            <label for="username">Password</label>
            <input type="password" name="password">
            <button type="submit" name="submit">Login</button>
        </form>
    </div>
</body>
</html>