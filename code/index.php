<?php
require_once("src/basicFunctions.php");
require_once("src/Database/DB.php");
require_once("src/Database/User.php");
require_once("src/Database/Contacto.php");

session_start();
checkUser();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["LogOut"])) {
        session_destroy();
        header("Location: login.php");
    }
    else if (isset($_POST["crearContacto"])) {
        crearContacto($_POST);
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
    <link rel="shortcut icon" href="static/icons/logo.svg">
    <title>Pavon Chat</title>
</head>

<body>
    <?php setHeaderIndex($user) ?>
    <main>
        <section id="createContact">
            <button class="button" id="openDialog">Create contact</button>
            <dialog id='modal'>
                    <h2>CREAR CONTACTO</h2>
                    <form method='POST' action='?' enctype="multipart/form-data">
                        <input type="text" name="Name" placeholder="Name" class="basicInput">
                        <input type="text" name="Surnames" placeholder="Surnames" class="basicInput">
                        <input type="text" name="PhoneNumber" placeholder="Phone Number" class="basicInput">
                        <div class="selectAvatar">
                            <label for="avatar" class="button">Select Avatar</label>
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
        <section id="contacts">
            <?php
            $db = createDB();
            $contactoDB = new Contacto($db);
            $contacts = $contactoDB->getContactsById($user["ID"]);
            if ($contacts->num_rows > 0) {
                while ($contact = $contacts->fetch_assoc()) {

                    // echo "<div class='contact'>";
                    // echo "<img src='static/icons/user.svg' alt='User'>";
                    // echo "<p>${contact["name"]}</p>";
                    // echo "</div>";
                }
            }
            ?>
        </section>
    </main>
    <?php setFooter() ?>
</body>

</html>