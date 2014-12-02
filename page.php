
<!DOCTYPE html>
<html>
    <head>
        <title>User Page</title>
        <link id = "pagestyle" rel="stylesheet" type="text/css" href="large.css"></link>
    </head>
    <script type="text/javascript">
    function layoutHandler(){
        var styleLink = document.getElementById("pagestyle");
        if ( /Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || window.innerWidth < 900){
            styleLink.setAttribute("href", "mob.css");
        }else{
            styleLink.setAttribute("href", "large.css");
        }
    }
    window.onresize = layoutHandler;
    layoutHandler();
    </script>
    <body>
        <div id="container">
            <h1>User Listings</h1>
        </div>
        <div id="left">
            <form name="adduser" method="POST" enctype="multipart/form-data" action="">
                <table>
                    <tr><th><label for="firstname"></label></th><td><input value="first name" type="text" id="firstname" name="firstname"/><div class="post" style="display: none;"></div></td></tr>
                    <tr><th><label for="lastname"></label></th><td><input value="last name" type="text" id="lastname" name="lastname"/><div class="post" style="display: none;"></div></td></tr>
                    <tr><th><label for="email"></label></th><td><input value="email" type="text" id="email" name="email"/><div class="post" style="display: none;"></div></td></tr>
                    <tr><th><label for="Add Name"></label></th><td><input type="submit" id="AddName" name="AddName"></button><div class="post" style="display: none;"></div></td></tr>
                </table>
            </form>
        </div>
        <div id="right">

        <?php

$servername = "localhost";
$username = "root";
$password = "Ur0b0r0us";
$dbname = "test";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//$sql = "INSERT INTO MyGuests (firstname, lastname, email)
//VALUES ('Elsa', 'ice', 'Elsa@example.com')";
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if (!empty($_POST["AddName"])){
        echo "hello world";
        $firstname = $_POST["firstname"];
        $lastname  = $_POST["lastname"];
        $email = $_POST["email"];

        $sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES ('" . $firstname . "','" . $lastname . "','" . $email . "')";

        $conn->query($sql);
    }
    if (!empty($_POST["select"])){
        $name = $conn->query("SELECT firstname, lastname FROM MyGuests WHERE email='" . $_POST["username"] . "'");
        $result = $name->fetch_assoc();
        echo "<div name=\"greetings\">Hello " . $result["firstname"] . " " . $result["lastname"] . "!</div>\n";
    }
}

$names = $conn->query("SELECT firstname, lastname, email FROM MyGuests");
echo "            <form name=\"getuser\" method=\"POST\" enctype=\"multipart/form-data\" action=\"\">";

echo "<table><tr><th><select name=\"username\">\n";
while($row = $names->fetch_assoc()){
    echo "            <option value=\"" . $row["email"] . "\">" . $row["email"] . "</option>\n";
}
echo "</select></br></tr></th>\n";
$conn->close();
?>
            <tr><th><label form="select"></label><input type="submit" id="select" name="select"></tr></th><div class="post" style="display: none;"></div>
        </form>
    </body>
</html>




