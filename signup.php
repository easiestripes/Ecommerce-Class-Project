<?php

include('inc/db_connect.php');

$errors = '';

if(isset($_POST['submit'])) {
    $name = filter_input(INPUT_POST, "name");
    $email = filter_input(INPUT_POST, "email");
    $address = filter_input(INPUT_POST, "address");
    $city = filter_input(INPUT_POST, "city");
    $state = filter_input(INPUT_POST, "state");
    $zip_code = filter_input(INPUT_POST, "zip_code");

    //check injections
    if(IsInjected($name))
        $errors .= "\n Bad name value!";
    if(IsInjected($email))
        $errors .= "\n Bad email value!";
    if(IsInjected($address))
        $errors .= "\n Bad address value!";
    if(IsInjected($city))
        $errors .= "\n Bad city value!";
    if(IsInjected($zip_code))
        $errors .= "\n Bad zip code value!";

    //do if no errors
    if(empty($errors)) {
        $sql = "INSERT INTO customer_info VALUES (NULL, '$name', '$email', '$address', '$city', '$state', '$zip_code')";
        $result = $mysqli->query($sql);

        print "<h1>Sucessfully signed up!</h1>";
    }
}

function IsInjected($str)
{
    $injections = array('(\n+)', '(\r+)', '(\t+)', '(%0A+)', '(%0D+)', '(%08+)', '(%09+)');
    $inject = join('|', $injections);
    $inject = "/$inject/i";
    if(preg_match($inject,$str))
        return true;
    else
        return false;
}

?>

<!DOCTYPE html>

<html>
	<head>
        <title>YouFit</title>
        <meta name="description" content="website description" />
        <meta name="keywords" content="website keywords, website keywords" />
        <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <!-- modernizr enables HTML5 elements and feature detects -->
        <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/component.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	</head>

	<body>

    <div class="container">
        <?php
            if(!empty($errors)){
                echo "<p style='color: #F00'>".nl2br($errors)."</p>";
            }
        ?>
        <form method="post" name="signup_form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <div class="order-form-header">Contact info:</div><br />
            <!--name-->
            <input type="text" name="name" placeholder="full name" class="form-control" value='<?php echo htmlentities($name) ?>' required><br />
            <!--email-->
            <input type="text" name="email" placeholder="email" class="form-control" value='<?php echo htmlentities($email) ?>' required><br />
            <!--address-->
            <input type="text" name="address" placeholder="address" class="form-control" value='<?php echo htmlentities($address) ?>' required><br />
            <!--city-->
            <input type="text" name="city" placeholder="city" class="form-control" value='<?php echo htmlentities($city) ?>' required><br />
            <!--state-->
            <select name="state" class="form-control" required>
                <option value="AL">Alabama</option>
                <option value="AK">Alaska</option>
                <option value="AZ">Arizona</option>
                <option value="AR">Arkansas</option>
                <option value="CA">California</option>
                <option value="CO">Colorado</option>
                <option value="CT">Connecticut</option>
                <option value="DE">Delaware</option>
                <option value="DC">District Of Columbia</option>
                <option value="FL">Florida</option>
                <option value="GA">Georgia</option>
                <option value="HI">Hawaii</option>
                <option value="ID">Idaho</option>
                <option value="IL">Illinois</option>
                <option value="IN">Indiana</option>
                <option value="IA">Iowa</option>
                <option value="KS">Kansas</option>
                <option value="KY">Kentucky</option>
                <option value="LA">Louisiana</option>
                <option value="ME">Maine</option>
                <option value="MD">Maryland</option>
                <option value="MA">Massachusetts</option>
                <option value="MI">Michigan</option>
                <option value="MN">Minnesota</option>
                <option value="MS">Mississippi</option>
                <option value="MO">Missouri</option>
                <option value="MT">Montana</option>
                <option value="NE">Nebraska</option>
                <option value="NV">Nevada</option>
                <option value="NH">New Hampshire</option>
                <option value="NJ">New Jersey</option>
                <option value="NM">New Mexico</option>
                <option value="NY">New York</option>
                <option value="NC">North Carolina</option>
                <option value="ND">North Dakota</option>
                <option value="OH">Ohio</option>
                <option value="OK">Oklahoma</option>
                <option value="OR">Oregon</option>
                <option value="PA">Pennsylvania</option>
                <option value="RI">Rhode Island</option>
                <option value="SC">South Carolina</option>
                <option value="SD">South Dakota</option>
                <option value="TN">Tennessee</option>
                <option value="TX">Texas</option>
                <option value="UT">Utah</option>
                <option value="VT">Vermont</option>
                <option value="VA">Virginia</option>
                <option value="WA">Washington</option>
                <option value="WV">West Virginia</option>
                <option value="WI">Wisconsin</option>
                <option value="WY">Wyoming</option>
            </select>
            <br />
            <!--zip code-->
            <input type="text" name="zip_code" placeholder="zip code" class="form-control" value='<?php echo htmlentities($zip_code) ?>' required><br />
            <input type="submit" name="submit" value="Sign Up" class="btn btn-default">
        </form>
    </div>

	</body>
</html>