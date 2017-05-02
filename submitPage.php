<?php
//Firing This Function When Ever Something Goes Wrong
function notIdeal($message, $page){
    echo "<div style='text-align: center'>";
    echo "<h3 style='color: orangered; display:inline-block; width: auto; padding: 2em; margin-top: 16%;'>".$message."</h3>";
    echo "</div>";
    header( "refresh:2;url=".$page);

}
// Removing Malicious Parts Of Input
function clearInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
//Checking If The Method Of Entry Is Post And not Get :)
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if (isset($_POST['submit'])){ //Checking If Form Is Submitted
            //collection all the data from the form
            //Main Details
            $activated = 0;
            $fullname = clearInput($_POST['fullname']);
            $mobileno = clearInput($_POST['mobileno']);
            $accountType = clearInput($_POST['accountType']);
            $adressline = clearInput($_POST['adressline']);
            $landmark = clearInput($_POST['landmark']);
            $pincode = clearInput($_POST['pincode']);
            $country = clearInput($_POST['country']);
            //Extra Details
            $adharno = clearInput($_POST['adharno']);
            $panno = clearInput($_POST['panno']);
            $noofapps = clearInput($_POST['noofapps']);
            $nomineename = clearInput($_POST['nomineename']);
            $nomineeaccno = clearInput($_POST['nomineeaccno']);
            $declared = clearInput($_POST['declared']);

        }else{
            notIdeal("You Made An Error Submitting The Form Please Recheck It!", "NewCustomer.html");
        }
}else{
    notIdeal("This Is Not A Page That Has Direct Access !", "index.html");
}

?>
<?php if (isset($activated)): ?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$fullname?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous">
    </script>
    <!-- Latest compiled and minified BTS-3 JavaScript -->
    <script
        src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous">
    </script>
</head>
<body>
<div class="container" style="text-align: center">
    <h3 class="text-success">The Details Of Your Application!</h3>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active" style="text-align: center">
                <h3>Main Details</h3>
                <div class="well well-sm" style="text-align: center">
                <p class="text-warning"></p>
                    <p class="text-primary">FullName : <?=$fullname?></p>
                    <p class="text-warning"> Address Line: <?= $adressline?></p>
                    <p class="text-primary"> Landmark: <?= $landmark?></p>
                    <p class="text-warning"> Country: <?= $country?></p>
                    <p class="text-primary"> PinCode: <?= $pincode?></p>
                    <p class="text-warning"> Mobile Number: <?= $mobileno?></p>
                    <p class="text-primary">Account Type : <?= $accountType?></p>
                </div>
            </div>

            <div class="item" style="text-align: center">
                <h3>Extra Information</h3>
                <div class="well well-sm" style="text-align: center">
                    <p class="text-primary"> Pan Card Number: <?= $panno?></p>
                    <p class="text-warning">Adhar Card Number : <?= $adharno?></p>
                    <p class="text-primary"> Nominee Account Number: <?= $nomineename?></p>
                    <p class="text-warning"> Nominee Name: <?= $nomineename?></p>
                    <p class="text-primary">No Of Applicants : <?= $noofapps?></p>
                    <p class="text-warning">Agrement Accepted: <?= $declared?></p>

                </div>
            </div>

            <div class="item" style="text-align: center">
                <h3>Manager Check</h3>
                <div class="well well-sm" style="text-align: center">
                    <p class="text-success">
                        The Data You Filled will be Sent To The Manager For Further Validation. <br>
                        And Furtherly You Will Receive a message upon Account Activation <br>
                        And Finally You Need To Come To The Bank To Receive All Account Related Stuff (Account Book / ATM Card etc.,)
                        <br>
                    </p>
                </div>
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
</body>
</html>
    <?php
    $host = "localhost";
    $uname = "root";
    $pass = "";
    $database = "srakshay";
// Creating database connection
    $query = new mysqli($host, $uname, $pass, $database);
// Checking for valid connection connection
    if ($query->connect_error) {
        die("Connection failed: ".$query->connect_error);
    }
//sql1 for main Datails
    $sql1 = "INSERT INTO coredetails (
activated, fullname, addressline, landmark, country, accountType, mobileno, pincode) VALUES 
('$activated', '$fullname', '$adressline', '$landmark', '$country', '$accountType', '$mobileno', '$pincode')";
//sql2 for Address
    $sql2 = "INSERT INTO extras (
adharno, panno, nomineename, nomineeaccno, noofapps) VALUES 
('$adharno', '$panno', '$nomineename', '$nomineeaccno', '$noofapps')";
//running 3 queries and checking for errors
    if ($query->query($sql1) === TRUE && $query->query($sql2) === TRUE){
        echo "<div style='text-align: center'>";
        echo "<h3 style='color: lightseagreen; display:inline-block; width: auto; padding: 2em; margin:auto;'>".
            "Data Sent To Manager To Activate Account"."</h3>";
        echo "</div>";
    } else {
        echo "<div style='text-align: center'>";
        echo "<h3 style='color: red; display:inline-block; width: auto; padding: 2em; margin:auto;'>".
            "Error: ".$sql1."<br>".$sql2."<br>".$query->error."</h3>";
        echo "</div>";
    }
//closing the database connection
$query->close();
    ?>
<?php endif; ?>



