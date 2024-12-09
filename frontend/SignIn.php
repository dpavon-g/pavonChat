<?php
    require_once("src/basicFunctions.php");
    require_once("src/Database/DB.php");
    require_once("src/Database/User.php");
    session_start();

    $status = [
        "Error" => false, 
        "Message" => ""
    ];
    if (isPostMethod()) {
        $body = $_POST;
        if (isset($body["Create"]) && $body["Create"] == "Create Account") {
            $user = array();
            list($status, $user) = checkBodyContent($user, $body, "Password2", "Repeat password is required", $status);
            list($status, $user) = checkBodyContent($user, $body, "Password", "Password is required", $status);
            list($status, $user) = checkBodyContent($user, $body, "Username", "Username is required", $status);

            if ($user["Password"] != $user["Password2"]) {
                $status["Error"] = true;
                $status["Message"] = "Passwords do not match";
            }
        }
        if ($status["Error"] == false) {
            $db = createDB();
            $userDB = new User($db);
            
            if ($userDB->checkUserByUsername($user["Username"]) > 0) {
                $status["Error"] = true;
                $status["Message"] = "Username already exists";
            } else {
                $user = saveAvatar($user);
                if ($userDB->createAccount($user) == false) {
                    $status["Error"] = true;
                    $status["Message"] = "Error creating account";
                }
                else {
                    $_SESSION["User"] = $userDB->getUserByPhoneNumber($user["Username"]);
                    header("Location: index.php");
                }
            }
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
    <title>SignIn</title>
</head>
<body>
    <?php setHeader() ?>
    <main>
        <?php
            if ($status["Error"] == true) {
                $message = $status["Message"];
                echo "<h3 id='errorMsg'> ${message} </h3>";
            }
        ?>
        <form action="?" method="post" enctype="multipart/form-data">
            <h2>Sign In</h2>
            <input class="basicInput" type="text" name="Username" placeholder="Phone Number" autocomplete="off">
            <input class="basicInput" type="password" name="Password" placeholder="Password" autocomplete="off">
            <input class="basicInput" type="password" name="Password2" placeholder="Repeat Password" autocomplete="off">
            <div class="selectAvatar">
                <label for="avatar" class="button">Select Avatar</label>
                <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" />
            </div>
            <input class="button" type="submit" name="Create" value="Create Account">
        </form>
    </main>
    <?php setFooter() ?>
</body>
</html>