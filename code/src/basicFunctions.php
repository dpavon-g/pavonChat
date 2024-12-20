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

function setHeaderIndex($user, $search = false) {

    $avatar = $user["avatar"];
    $url = "static/avatars/${avatar}";
    $username = $user["phoneNumber"];
    if (!$search) {
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
    else {
        echo "
                <header class='finder'>
                    <a href='login.php'><h1 class='nunito'>Pavon Chat</h1></a>
                    <form method='GET' action='?'>
                        <input type='text' autocomplete='off' name='User' placeholder='Search user' class='basicInput'>
                    </form>
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
}

function setFooter()
{
    echo "
            <footer>
                <a href='https://es.linkedin.com/in/pavondaniel' target='_blank'>
                    <h3 class='nunito'>© Developed with <span id='love'><3</span> by Daniel Pavón</h3>
                </a>
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

function crearContacto($body) {
    $db = createDB();
    $contactoDB = new Contacto($db);
    $userDB = new User($db);
    
    $contacto = array(
        "Name" => $body["Name"],
        "Surnames" => $body["Surnames"],
        "PhoneNumber" => $body["PhoneNumber"],
        "UserID" => $_SESSION["User"]["id"]
    );

    if ($userDB->checkUserByUsername($contacto["PhoneNumber"]) > 0) {
        if (!isset($_FILES["avatar"]["name"]) || empty($_FILES["avatar"]["name"])) {
            $contacto["Avatar"] = "gatito.jpg";
        } else {
            $contacto["Avatar"] = $_FILES["avatar"]["name"];
            $avatar = $_FILES["avatar"]["name"];
            $rutaTemporal = $_FILES["avatar"]["tmp_name"];
            move_uploaded_file($rutaTemporal, __DIR__ . "/../static/avatars/${avatar}");
        }
    
        $contactoDB->createContact($contacto);
    }
    else {
        return false;
    }
    return true;
}

function drawContact($contact) {
    $DB = createDB();
    echo "
        <a href='chat.php?contactID=${contact["id"]}' class='contactCard'>
            <img src='static/avatars/${contact["photo"]}' alt='Avatar'>
            <div>
                <h3>${contact["name"]} ${contact["surnames"]}</h3>
                <p>${contact["phoneNumber"]}</p>
            </div>
        </a>";
}