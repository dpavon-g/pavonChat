<?php
    require_once("src/basicFunctions.php");
    require_once("src/Database/DB.php");
    require_once("src/Database/User.php");

    session_start();

    if (isset($_SESSION["User"]))
        header("Location: index.php");
    if (isPostMethod()) {
        if (isset($_POST["Login"])) {
            $db = createDB();
            $userDB = new User($db);
            $username = $_POST["Username"];
            $password = $_POST["Password"];
            $user = $userDB->getUserByPhoneNumber($username);
            if (password_verify($password, $user["passwd"])) {
                $_SESSION["User"] = $user;
                header("Location: index.php");
            }
        }
        else if (isset($_POST["SignIn"]) && $_POST["SignIn"] == "Sing In") {
            header("Location: SignIn.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/basicStyle.css">
    <link rel="stylesheet" href="static/css/login.css">
    <link rel="shortcut icon" href="static/icons/logo.svg">
    <title>Login</title>
</head>
<body>
    <?php setHeader() ?>
    <main>
        <form action="?" method="post">
            <h2>Login</h2>
            <input class="basicInput" type="text" name="Username" placeholder="Phone Number" autocomplete="off">
            <input class="basicInput" type="password" name="Password" placeholder="Password" autocomplete="off">
            <div class="buttons">
                <input class="button" type="submit" name="Login" value="Login">
                <input class="button" type="submit" name="SignIn" value="Sing In">
            </div>
        </form>
    </main>
    <?php setFooter() ?>
</body>
</html>