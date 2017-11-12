<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="description" content="Making New Form and Save Data to New File in PHP" />
        <meta name="keywords" content="Form,File,PHP" />
        <meta name="author" content="Khaldoon Al Krad" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>PHP Course Form</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
        <link rel="stylesheet" type="text/css" href="mystyle.css" />
      
    </head>
<?php

$firstname = $lastname = $gender = $address = $city = $country = $phone = $email = "";
$firstnameErr = $lastnameErr = $genderErr = $addressErr = $cityErr = $countryErr = $phoneErr = $emailErr = "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["firstname"])) {
        $firstnameErr = "First Name is required";
    } else {
        $firstname = test_input($_POST["firstname"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
            $firstnameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["lastname"])) {
        $lastnameErr = "Last Name is required";
    } else {
        $lastname = test_input($_POST["lastname"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $lastname)) {
            $lastnameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
    } else {
        $address = test_input($_POST["address"]);
    }

    if (empty($_POST["city"])) {
        $cityErr = "City name is required";
    } else {
        $city = test_input($_POST["city"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "Phone is required";
    } else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match('/^0\d{9}$/', $phone)) {
            $phoneErr = "Invalid phone number";
        }
    }
}

$filename = $firstname.$lastname.".txt";
$myfile = fopen($filename, "w");
$txt1 = "Name: " . $firstname . " " . $lastname."\n"."Gender:".$gender."\n";
$txt2 = "Address: " . $address . ", " . $city."\n";
$txt3 = "Phone: " . $phone . "\n"."email: " . $email;
fwrite($myfile, $txt1);
fwrite($myfile, $txt2);
fwrite($myfile, $txt3);
fclose($myfile);

echo"<p> A file has been created called <br>  ". $filename."<br>".realpath($filename). " <br> has all information about you.</p>";



