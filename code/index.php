<?php
require_once("src/basicFunctions.php");
require_once("src/Database/DB.php");
require_once("src/Database/User.php");
require_once("src/Database/Contacto.php");

session_start();
checkUser();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = array();
    $status["error"] = false;
    if (isset($_POST["LogOut"])) {
        session_destroy();
        header("Location: login.php");
    }
    else if (isset($_POST["crearContacto"])) {
        if (!crearContacto($_POST)) {
            $status["error"] = true;
            $user = $_POST["PhoneNumber"];
            $status["message"] = "Error, user ${user} doesn't exist.";
        }
    }
}
$user = $_SESSION["User"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/basicStyle.css">
    <link rel="stylesheet" href="static/css/index.css">
    <link rel="stylesheet" href="static/css/header.css">
    <link rel="shortcut icon" href="static/icons/logo.svg">
    <title>Pavon Chat</title>
</head>

<body>
    <?php setHeaderIndex($user, true) ?>
    <main>
        <section id="createContact">
            <button class="button" id="openDialog">Create contact</button>
            <dialog id='modal'>
                    <h2>CREAR CONTACTO</h2>
                    <form method='POST' action='?' enctype="multipart/form-data">
                        <input type="text" autocomplete="off" name="Name" placeholder="Name" class="basicInput">
                        <input type="text" autocomplete="off" name="Surnames" placeholder="Surnames" class="basicInput">
                        <input type="text" autocomplete="off" name="PhoneNumber" placeholder="Phone Number" class="basicInput">
                        <div class="selectAvatar">
                            <label for="formAvatar" class="button">Select Avatar</label>
                            <input type="file" id="formAvatar" name="avatar" accept="image/png, image/jpeg" />
                        </div>
                        <div>
                            <input type='button' id='closeDialog' value='Cancel' class='button'>
                            <input type='submit' value='Create Contact!' class='button'>
                        </div>
                        <input type="hidden" name="crearContacto" value="true">
                    </form>
                </dialog> 
            <script>
                document.getElementById('openDialog').addEventListener('click', () => {
                    document.getElementById('modal').showModal();
                });

                document.getElementById('closeDialog').addEventListener('click', () => {
                    document.getElementById('modal').close();
                });
            </script>
        </section>
        <section id="errorMsg">
            <?php
                if ($status["error"] == true) {
                    $msg = $status["message"];
                    echo "<h3> ${msg} </h3>";
                }
            ?>
        </section>
        <section id="contacts">
            <?php
            $db = createDB();
            $contactoDB = new Contacto($db);
            $contacts = $contactoDB->getContactsById($user["id"]);
            if ($contacts->num_rows > 0) {
                while ($contact = $contacts->fetch_assoc()) {
                    if (isset($_GET["User"])) {
                        if (strpos($contact["phoneNumber"], $_GET["User"]) === 0) {
                            drawContact($contact);
                        }
                    } else {
                        drawContact($contact);
                    }
                }
            }
            ?>
        </section>
    </main>
    <?php setFooter() ?>
</body>

</html>