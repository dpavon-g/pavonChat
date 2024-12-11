<?php
    require_once("src/basicFunctions.php");
    require_once("src/Database/DB.php");
    require_once("src/Database/User.php");
    require_once("src/Database/Contacto.php");
    require_once("src/Database/Mensajes.php");
    session_start();
    checkUser();
    $DB = createDB();
    $DBMensajes = new Mensajes($DB);
    $DBContacto = new Contacto($DB);
    $DBUser = new User($DB);

    if (isset($_GET["contactID"]) && !empty($_GET["contactID"])) {
        $destinatarioId = $_GET["contactID"];
        $destinatarioUser = $DBContacto->getFullContactInfo($destinatarioId);
        if (empty($destinatarioUser)) {
            header("Location: index.php");
        }
    }
    else {
        header("Location: index.php");
    }

    if (isPostMethod()) {
        $destinatarioId = $_GET["contactID"];
        if (isset($_POST["mensajeEnviado"])) {
            $mensaje = array();
            $mensaje["mensaje"] = $_POST["mensaje"];
            $mensaje["remitenteId"] = $_SESSION["User"]["id"];
            $mensaje["receptorId"] = $_POST["mensajeEnviado"];
            $DBMensajes->createMessage($mensaje);
            header("Location: chat.php?contactID=${destinatarioId}");
        }
    }
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
                    <h2 class="nunito">
                        <?php
                            echo $destinatarioUser["name"] . " " . $destinatarioUser["surnames"];
                        ?>
                    </h2>
                </div>
                <h2 class="nunito">
                    <?php
                        echo $destinatarioUser["phoneNumber"];
                    ?>
                </h2>
            </div>
            <div id="mensajes">
                <?php
                    $conversacion = $DBMensajes->getConversation($_SESSION["User"]["id"], $destinatarioId);
                    if ($conversacion->num_rows > 0) {
                        while ($mensaje = $conversacion->fetch_assoc()) {
                            $fecha = new DateTime($mensaje["fecha_envio"]);
                            $hora = $fecha->format("H:i:s");
                            if ($mensaje["remitente_id"] == $_SESSION["User"]["id"])
                                $tipoMensaje = "mensajeRight";
                            else
                                $tipoMensaje = "mensajeLeft";
                            echo "
                                <div class='${tipoMensaje}'>
                                    <div class='mensaje'>
                                        <p class='nunito'>${mensaje["mensaje"]}</p>
                                        <p class='nunito fecha'>${hora}</p>
                                    </div>
                                </div>
                            ";
                        }
                    }
                ?>
            </div>
            <div id="sendMensaje">
                <?php
                    echo "
                        <form action='?contactID=${destinatarioId}' method='post'>
                            <input type='text' autocomplete='off' name='mensaje' id='mensaje' class='basicInput writeMSG' placeholder='Write a message...' required>
                            <input type='submit' value='Send' class='button'>
                            <input type='hidden' name='mensajeEnviado' value='${destinatarioId}'>
                        </form>
                    ";
                ?>
            </div>
        </section>
    </main>
    <?php setFooter() ?>
</body>
</html>