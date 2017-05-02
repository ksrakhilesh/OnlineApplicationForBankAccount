<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Activating Users</title>
</head>
<body>
<div class="container">
    <div style="margin-top: 2%"></div>
    <?php
    session_start();
    //defining neccesary functions
    //for Checking Form Submitiom
    function checkset($value)
    {
        if (isset($value) && !($value == ''))
            return true;
        else
            return false;
    }

    //for filtering form inputs
    function bestInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //If Somethng Coes Wrong
    function redirectMessage($message, $url)
    {
        echo $message;
        header("refresh:2;url=$url");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accept'])) {
        $user_id = $_POST['id_needed'];
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "srakshay";
        $mysqli = new mysqli($servername, $username, $password, $dbname);
        $query = "UPDATE coredetails SET activated='1' WHERE id=$user_id";
        $mysqli->query($query);
        $mysqli->close();
        header("Refresh:0");
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reject'])) {
        $user_id = $_POST['id_needed'];
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "srakshay";
        $mysqli = new mysqli($servername, $username, $password, $dbname);
        $query1 = "DELETE FROM coredetails WHERE id=$user_id";
        $query2 = "DELETE FROM extras WHERE user=$user_id";
        $mysqli->query($query1);
        $mysqli->query($query2);
        $mysqli->close();
        header("Refresh:0");
    }
    $username = 'guest';
    $password = 'guest';
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['managerLogin']) && checkset($_POST['username']) && checkset($_POST['password'])) {
        if (bestInput($_POST['username']) == $username && bestInput($_POST['password']) == $password) {
            $_SESSION['login'] = "YesLoggedIn";
        } else {
            redirectMessage("Incorrect Username/Password Please Re-enter", "Manager.html");
        }
    }

    if (isset($_SESSION['login'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "srakshay";
        $mysqli = new mysqli($servername, $username, $password, $dbname);
        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        function printAllDetailsOfID($id)
        {
            global $mysqli;
            $query = "SELECT fullname, accountType, landmark, pincode, country FROM coredetails WHERE id = $id";
            if ($result = $mysqli->query($query)) {
                /* fetch object array */
                while ($item = $result->fetch_row()) {
                    echo "<ul class=\"list-group\">
                <li class=\"list-group-item active\">Full Name: &nbsp;  $item[0]</li>
                <li class=\"list-group-item\">Account Type: &nbsp;  $item[1]</li>
                <li class=\"list-group-item\">Landmark: &nbsp;  $item[2]</li>
                <li class=\"list-group-item\">Country: &nbsp;  $item[4]</li>
                <li class=\"list-group-item\">Pin Code: &nbsp;  $item[3]</li>";
                }
                /* close connection */
                $result->close();
            }
            $query = "SELECT panno, adharno, nomineename, nomineeaccno FROM extras WHERE user = $id";
            if ($result = $mysqli->query($query)) {
                /* fetch object array */
                while ($item = $result->fetch_row()) {
                    echo "
            <li class=\"list-group-item\">Adhar No: &nbsp; $item[1]</li>
            <li class=\"list-group-item\">Pan Card No.: &nbsp;  $item[0]</li>
             <li class=\"list-group-item\">Nominee Name: &nbsp;  $item[2]</li>
             <li class=\"list-group-item\">Nominee Acc No: &nbsp;  $item[3]</li>
            </ul>";
            }
                echo '<form method="POST" action="managerLoggedIn.php">';
                echo "<input type='hidden' value= '$id' name='id_needed'>";
                echo "<input type = 'submit' name='reject' value='Reject' class='btn btn-danger btn-sm'>";
                echo "        ";
                echo "<input type = 'submit' name='accept' value='Accept' class='btn btn-success btn-sm'>";
                echo "</form>";
                echo "<hr>";
                /* close connection */
                $result->close();
            }

        }

        $query = "SELECT id FROM coredetails WHERE activated = 0";
        if ($result = $mysqli->query($query)) {
            /* fetch object array */
            while ($item = $result->fetch_row()) {
                printAllDetailsOfID($item[0]);
            }
            /* close connection */
            $result->close();
            $mysqli->close();
        } ?>
        <a href="?click=1" class="btn btn-primary btn-sm">Logout</a>
    <?php } else {
        redirectMessage("Please Fill All The Feilds In The Form", "Manager.html");
    }

    ?>

    <?php
    function doSomething()
    {
        session_destroy();
        header("Location: Manager.html");
    }

    if (isset($_GET['click'])) {
        doSomething();
    }
    ?>
</div>
</body>
</html>