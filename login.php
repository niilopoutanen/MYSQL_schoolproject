<?php
    include("sqlcommands.php");
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "SELECT * FROM guest WHERE email = '" . $_POST["email"] . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                $newurl = "index.php?user=" . $row["guest_ID"];
                header('Location: '.$newurl);
        }
        } else {
        echo '<p class="error">Käyttäjää ei löytynyt</p>';
        }
        $conn->close();
    }


?>
<html>
    <head>
        <title>Kirjaudu tilillesi</title>
        <link rel="stylesheet" type="text/css" href="accountstyles.css">
    </head>
    <body>
        <main>
            <h1>Kirjaudu</h1>
            <form action="login.php" method="post" autocomplete="off">
                <input type="text" name="email" placeholder="Sähköposti" required="required"/>
                <button type="submit">Kirjaudu</button>
            </form>
        </main>
    </body>
</html>