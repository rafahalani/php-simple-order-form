<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>Order food & drinks</title>
</head>
<body>
<?php
$errors =checkValidation($_POST); //first  take all the errors after validate the inputs
errorPrint($errors); // apply error function on the errors (get all the errors)

if (!empty($_POST["products"])) {
    $new_sum = array_sum($_POST["products"]["price"]); //add the value of the products (sum)
} else {
    $new_sum = 0;
}
if (empty($errors)) { //if there is no errors then you can count

    $baseValue = 0;
    $cookie_name = 0 ;
    if (isset($_COOKIE["total"])) {

        $cookie_value = $_COOKIE[$cookie_name];
         }
    else {
        $cookie_value = 0;
        }
    $cookie_value += $baseValue + $new_sum;
    setcookie($cookie_name, (string)$cookie_value);
    if (isset($_COOKIE[$cookie_name])) {
        $totalValue = $_COOKIE[$cookie_name];
    } else {
        $totalValue = 0;
    }

}
?>
<div class="container">
    <h1>Order food in restaurant "the Personal Ham Processors"</h1>
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for='email'>E-mail:</label>
                <input type="text" id="email" name="email" class="form-control" value="<?php echo $email ?>">

            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" value="<?php echo $street ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control"
                           value="<?php echo $streetnumber ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" value="<?php echo $city ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?php echo $zipcode ?>">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php
            var_dump($_GET["food"]);


            foreach ($products AS $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?>
                    -
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br/>
            <?php endforeach; ?>
        </fieldset>
        <fieldset>
            <legend>Express Dilivery </legend>
            <label>
                <input type="checkbox" value="1" name="dilivery"/>
               <p> + 7  &euro; </p>
            </label>
        </fieldset>

        <button type="submit" class="btn btn-primary">Order!</button>
    </form>


    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>