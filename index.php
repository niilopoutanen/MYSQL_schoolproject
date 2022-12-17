
<!DOCTYPE html>
<html>
    <head>
        <title>Hotelli-tietokannan käyttöliittymä</title>
        <script src="scripts.js"></script>
        <link rel="stylesheet" href="styles.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="popup_bg"></div>
        <div id="popup"></div>
        <nav>
            <div class="navbar_side">
            </div>
            <div>
                <h1>Hotelli-tietokannan käyttöliittymä</h1>
            </div>
            <div class="navbar_side">
                <button id="register_btn" onclick="MoveParamsToNew(window.location.search, 'register.php')">Luo tili</button>
                <button id="login_btn" class="primarybtn" onclick="MoveParamsToNew(window.location.search, 'login.php')">Kirjaudu</button>
                <button id="myaccount" onclick="TogglePopup()">Tili</button>
            </div>

        </nav>
        <main>
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "Hotel";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }
                $sql = "select room.availability, room_ID, room_img, room_number, hotel.hotel_name, hotel.city_name from room right join hotel on room.hotel_ID = hotel.hotel_ID;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while($row = $result->fetch_assoc()) {
                        if($row["availability"] == 1){
                            echo '
                            <div class="hotelcard" id="'. $row["room_ID"]. '">
                            <img src="'. $row["room_img"]. '"/>
                            <div class="headerdiv">
                                <div>
                                    <h2>'. $row["hotel_name"]. '</h2>
                                    <p>Huone '. $row["room_number"]. ', '. $row["city_name"]. '</p>
                                </div>
                                <button>Varaa</button>
                            </div>
                        </div>';
                        }
                }
                } else {
                echo "0 results";
                }
                $conn->close();


            ?>

            <!-- <div class="hotelcard">
                <img src="https://www.rantapallo.fi/wp-content/uploads/2020/01/suomi-helsinki-original-sokos-hotel-tripla-hotelli-ik-2.jpg"/>
                <div class="headerdiv">
                    <div>
                        <h2>Hotelli 1</h2>
                        <p>Katu 1, Kaupunki 1</p>
                    </div>
                    <button>Varaa</button>
                </div>
            </div> -->
        </main>
        <footer>
            <p>© 2022 Niilo Poutanen</p>
        </footer>
        <script>
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            if(urlParams.get('user') == null) {
                document.getElementById("login_btn").style.display = "inline-block";
                document.getElementById("register_btn").style.display = "inline-block";
                document.getElementById("myaccount").style.display = "none";
            } else {
                document.getElementById("login_btn").style.display = "none";
                document.getElementById("register_btn").style.display = "none";
                document.getElementById("myaccount").style.display = "inline-block";
            }
        </script>
    </body>
</html>