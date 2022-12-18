<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="reservationstyles.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <section>
            <div id="reservation_area">
                <h1>Huone 152- Scandic Helsinki</h1>
                <h2>Huoneen taso - Sviitti</h2>
        
                <form style="width: 26vw; display: flex; flex-direction:column; gap: 2vh;">
                    <div style="display: flex; justify-content: space-between;">
                        <div style="display: flex; flex-direction: column; width: 10.4vw; margin-right: 2vw;">
                            <p style="margin: 0;">Tulop&auml;iv&auml;:</p>
                            <input class="date_input" type="date" name="arrive" placeholder="Tulop&auml;iv&auml;"></input>
                        </div>
                        <div style="display: flex; flex-direction: column; width: 10.4vw;">
                            <p style="margin: 0;">L&auml;ht&ouml;p&auml;iv&auml;:</p>
                            <input class="date_input" type="date" name="leave" placeholder="L&auml;ht&ouml;p&auml;iv&auml;"></input>
                        </div>
                    </div>
                    <textarea name="requests" placeholder="Pyynt&ouml;j&auml; henkil&ouml;kunnalle?"></textarea>
                    <input style="width: 5.2vw; font-size: 1vw;" class="primarybtn" type="submit" value="Varaa"></input>
                </form>
            </div>
        </section>
        <section>
            <div id="room_img_area">
                <img src="https://raw.githubusercontent.com/niilopoutanen/MYSQL_lopputehtava/main/images/room2.jpg"/>
            </div>
        </section>


    </body>
</html>