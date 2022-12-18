<?php
    include("sqlcommands.php");
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "DELETE FROM reservation WHERE reservation_ID = '" . $_POST["reservationID"] . "'";
        if ($conn->query($sql) === TRUE) {
            $newurl = "index.php?user=" . $_POST["user"]; 
            header('Location: '.$newurl);
          } else {
            echo "Error deleting record: " . $conn->error;
        }
        $conn->close();
    }


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Hotelli-tietokannan käyttöliittymä</title>
        <script src="scripts.js"></script>
        <link rel="stylesheet" href="styles.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="popup_bg" style="display:none;"></div>
        <div id="popup" style="display:none;">
            <div id="popup_header">
                <?php
                    include("sqlcommands.php");

                    $sql = "SELECT concat(first_name, ' ', last_name) as fullname, email, phone FROM guest WHERE guest_ID = '" . $_GET["user"] . "'";
                    $result = $conn->query($sql);
    
                    if ($result->num_rows > 0) {
    
                        while($row = $result->fetch_assoc()) {
                            echo '
                                <h2>'. $row["fullname"]. '</h2>
                                <h4>'. $row["email"]. '</h4>
                                <h4>'. $row["phone"]. '</h4>
                            ';
                        }
                    } 
                    else {
                        echo "0 results";
                    }
    
                    $conn->close();
    
                ?>

            </div>
            <h4>Varaukset:</h4>
            <div id="reservationscontainer">
                <?php
                    include("sqlcommands.php");  
                    $userid = $_GET["user"];
                    if($userid != null){
                        $userdatasql = "SELECT hotel.hotel_name, reservation.reservation_start, reservation.reservation_end, reservation.reservation_ID FROM reservation LEFT JOIN hotel ON reservation.hotel_ID = hotel.hotel_ID WHERE guest_ID = $userid;";
                        $userdataresult = $conn->query($userdatasql);
                        if ($userdataresult->num_rows > 0) {
                            while($row = $userdataresult->fetch_assoc()) {
                                echo '
                                <div class="reservationpanel" id="'. $row["reservation_ID"]. '">
                                <h3>'. $row["hotel_name"]. '</h3>
                                <p>'. $row["reservation_start"]. ' - '. $row["reservation_end"]. '</p>
                                <form action="index.php" method="post" autocomplete="off">
                                <input type="hidden" name="reservationID" value="'. $row["reservation_ID"]. '">
                                <input type="hidden" name="user" value="'. $userid. '">
                                <button type="submit" style="margin-left:auto;" class="primarybtn">X</button>
                                </form>
                                </div>
                                ';
                            }
                        } 
                        else {
                            echo "Ei varauksia.";
                        }
                    }
                
                ?>
            </div>

            <button style="margin-top:auto; min-height:35px" class="primarybtn" onclick="TogglePopup()">Sulje</button>
        </div>
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
                include("sqlcommands.php");

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
                } 
                else {
                    echo "0 results";
                }

                $conn->close();


            ?>
        </main>
        <footer>
            <h3>© 2022 Niilo Poutanen</h3>
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