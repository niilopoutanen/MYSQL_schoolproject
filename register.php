<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Hotel";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }


    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $create_account_sql = "INSERT INTO guest (first_name, last_name, email, phone) 
        VALUES ('" . $_POST["firstname"] . "', '" . $_POST["lastname"] . "', '" . $_POST["email"] . "', '" . $_POST["phone"] . "')";
        $verifysql = "SELECT * FROM guest WHERE email = '" . $_POST["email"] . "'";
        $verifyresult = $conn->query($verifysql);
        if ($verifyresult->num_rows > 0) {
            echo '<p class="error">Käyttäjä on jo olemassa</p>';
        } 
        else {
            if ($finalresult = $conn->query($create_account_sql) === TRUE) {
                //luodun käyttäjän id:n hakeminen
                $searchsql = "SELECT * FROM guest WHERE email = '" . $_POST["email"] . "'";
                $result = $conn->query($searchsql);
                if ($result->num_rows > 0) {
        
                    while($row = $result->fetch_assoc()) {
                        $newurl = "index.php?user=" . $row["guest_ID"];
                        header('Location: '.$newurl);
                    }
                }
            } 
            else {
                echo '<p class="error">Käyttäjän luonti epäonnistui</p>';
            }
        }
        $conn->close();
    }


?>
<html>
    <head>
        <title>Käyttäjän luonti</title>
        <link rel="stylesheet" type="text/css" href="accountstyles.css">
    </head>
    <body>
        <main>
            <h1>Luo käyttäjä</h1>
            <form action="register.php" method="post" autocomplete="off">
                <input type="text" name="firstname" placeholder="Etunimi" required="required"/>
                <input type="text" name="lastname" placeholder="Sukunimi" required="required"/>
                <input type="text" name="email" placeholder="Sähköposti" required="required"/>
                <input type="text" name="phone" placeholder="Puhelinnumero" required="required"/>
                <button type="submit">Luo</button>
            </form>
        </main>
    </body>
</html>