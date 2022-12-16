<html>
    <head>
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body>

        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "Hotel";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            $search_term = $_POST['hotel_name'];
            $sql = "SELECT * FROM hotel WHERE hotel_name LIKE '%{$search_term}%' ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while($row = $result->fetch_assoc()) {
                echo $row["hotel_name"]. " - Osoite: " . $row["street_name"]. ", " . $row["city_name"]. "<br>";
            }
            } else {
            echo "0 results";
            }
            $conn->close();
        ?>
    </body>
</html>