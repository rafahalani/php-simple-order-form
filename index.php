<?php


//this line makes PHP behave in a more strict way
declare(strict_types=1);
//we are going to use session variables so we need to enable sessions

session_start();
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}
//your products with their price.
$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];
$products = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];


function errorPrint($errors)
{
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<div class="alert alert-danger" role="alert">' . $error . '</div>'; // returns value of the error from the  function
        }
    } elseif (!empty($_POST)) {
        echo '<div class="alert alert-success" role="alert">Your order is Sent!</div>'; // if there is no error print this
    }
}


function checkValidation(array $post): array
{
    $errors = [];
    if (empty($_POST)) {
        return $errors;
    } else {
        if (empty($_POST["email"])) {
            $errors[] = "Email is required";
        } else {
            // check if e-mail address is well-formed
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email";
            }
        }
        if (empty($post["street"])) {
            $errors[] = "Street is required";
        }
        if (empty($post["streetnumber"])) {
            $errors[] = "Streetnumber is required";
        } else {
            // check if streetnumber is a number
            if (!is_numeric($_POST["streetnumber"])) {
                $errors[] = "Streetnumber should be a number";
            }
        }
        if (empty($_POST["city"])) {
            $errors[] = "City is required";
        }
        if (empty($_POST["zipcode"])) {
            $errors[] = "Zipcode is required";
        } else {
            // check if streetnumber is a number
            if (!is_numeric($_POST["zipcode"])) {
                $errors[] = "Zipcode should be a number";
            }
        }
        if (empty($_POST["products"])){
            $errors[] = "Please select an item";
        }
    }
    return $errors;
}


$street = $streetnumber = $city = $zipcode = $email = "";
if (!empty($_POST)) {
    $email = $_POST["email"]; //  the email in $_POST it will not be saved in the browser
    $_SESSION["street"] = $_POST["street"]; // asign every $_POST to $_SESSION saves the value to the next browser
    $_SESSION["streetnumber"] = $_POST["streetnumber"];
    $_SESSION["city"] = $_POST["city"];
    $_SESSION["zipcode"] = $_POST["zipcode"];
}
if (!empty($_SESSION["street"])) {
    $street = $_SESSION["street"];
}
if (!empty($_SESSION["streetnumber"])) {
    $streetnumber = $_SESSION["streetnumber"];
}
if (!empty($_SESSION["city"])) {
    $city = $_SESSION["city"];
}
if (!empty($_SESSION["zipcode"])) {
    $zipcode = $_SESSION["zipcode"];
}
$totalValue = 0;
require 'form-view.php';
whatIsHappening();