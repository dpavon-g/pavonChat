<?php
    require_once("src/basicFunctions.php");
    require_once("src/Database/DB.php");
    require_once("src/Database/User.php");
    require_once("src/Database/Contacto.php");
    session_start();

    checkUser();

    $user = $_SESSION["User"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="static/icons/logo.svg">
    <link rel="stylesheet" href="static/css/basicStyle.css">
    <link rel="stylesheet" href="static/css/header.css">
    <link rel="stylesheet" href="static/css/chat.css">
    <title>Chat</title>
</head>
<body>
    <?php setHeaderIndex($user) ?>
    <main>
        <section id="contactChat">
            <div id="contactInfo">
                <div id="contactImageName">
                    <img id="chatAvatar" src="static/avatars/miau.jpeg" alt="User">
                    <h2 class="nunito">Nombre del usuario</h2>
                </div>
                <h2 class="nunito">636937716</h2>
            </div>
            <div id="mensajes">
                <div class="mensajeLeft">
                    <div class="mensaje">
                        <p class="nunito">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam, eum amet cumque doloribus enim commodi id at accusamus expedita quos cum velit saepe eaque dicta incidunt delectus obcaecati inventore minus!</p>
                        <p class="nunito fecha">10:07</p>
                    </div>
                </div>
                <div class="mensajeRight">
                    <div class="mensaje">
                        <p class="nunito">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam, eum amet cumque doloribus enim commodi id at accusamus expedita quos cum velit saepe eaque dicta incidunt delectus obcaecati inventore minus!</p>
                        <p class="nunito fecha">10:07</p>
                    </div>
                </div>
            </div>
            <div id="sendMensaje">
                <form action="?" method="post">
                    <input type="text" name="mensaje" id="mensaje" class="basicInput writeMSG" placeholder="Write a message...">
                    <input type='submit' value='Send' class='button'>
                    <input type="hidden" name="mensajeEnviado" value="mensajeEnviado">
                </form>
            </div>
        </section>
    </main>
    <?php setFooter() ?>
</body>
</html>