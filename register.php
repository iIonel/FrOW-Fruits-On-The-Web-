<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruits On The Web!</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
    <form method="POST" action="./includes/signup.php">
        <h1>Register</h1>
        <label for="first-name"></label>
        <input type="text" name="first-name" id="first-name" placeholder="First Name">
        <label for="last-name"></label>
        <input type="text" name="last-name" id="last-name" placeholder="Last Name">
        <label for="username"></label>
        <input type="text" name="username" id="username" placeholder="Username">
        <label for="email"></label>
        <input type="email" name="email" id="email" placeholder="Your Email">
        <label for="password"></label>
        <input type="password" name="password" id="password" placeholder="Password">
        <label for="confirm-password"></label>
        <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password">
        <button type="submit">Register</button>
        <a href="login.php">Have an account?</a>
        <?php
            if(isset($_GET['message'])){
                $errorMessage = urldecode($_GET['message']);
                echo '<p class="error-message">' . $errorMessage . '</p>';
            }
        ?>
        <h4>Try a new learning experience through play!</h4>
    </form>
    
</body>
</html>