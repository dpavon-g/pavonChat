<?php

function checkUser()
{
    if (!isset($_SESSION["User"]))
        header("Location: login.php");
}

function setHeader()
{
    echo "
            <header>
                <a href='login.php'><h1 class='nunito'>Pavon Chat</h1></a>
            </header>
        ";
}

function setHeaderIndex($user) {

    $avatar = $user["avatar"];
    $url = "static/avatars/${avatar}";
    $username = $user["phoneNumber"];
    echo "
            <header>
                <a href='login.php'><h1 class='nunito'>Pavon Chat</h1></a>
                <div class='user'>
                <h3 class='nunito'>${username}</h3>
                <img id='avatar' src='${url}' alt='Avatar'>
                <form action='?' method='post'>
                    <button type='submit' name='LogOut' id='logOut'>
                        <img src='static/icons/log-out.svg' alt='Logout'>
                    </button>
                </form>
                </div>
            </header>
        ";
}

function setFooter()
{
    echo "
            <footer>
                <h3 class='nunito'>© Proyecto desarrollado por Daniel Pavón</h3>
            </footer>
        ";
}

function isPostMethod()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        return true;
    }
    return false;
}

function setError($msg)
{
    $status = [
        "Error" => true,
        "Message" => $msg
    ];

    return $status;
}

function checkBodyContent($user, $body, $content, $ErrorMsg, $status)
{

    if (isset($body[$content]) && !empty($body[$content]))
        $user[$content] = $body[$content];
    else
        $status = setError($ErrorMsg);

    return [$status, $user];
}

function saveAvatar($user)
{
    if (!isset($_FILES["avatar"]["name"]) || empty($_FILES["avatar"]["name"])) {
        $user["Avatar"] = "gatito.jpg";
    } else {
        $user["Avatar"] = $_FILES["avatar"]["name"];
        $avatar = $_FILES["avatar"]["name"];
        $rutaTemporal = $_FILES["avatar"]["tmp_name"];
        move_uploaded_file($rutaTemporal, __DIR__ . "/../static/avatars/${avatar}");
    }

    return $user;
}
