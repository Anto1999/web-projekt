<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
<link href="style_reg.css" rel="stylesheet">
<script src="skripta1.js"></script>
</head>
<body>
    <div class="header">
        <h2>Registracija</h2>
    </div>

    <form method="post" action="register.php">

        <?php echo display_error(); ?>

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" echo $username;>
        </div>

        <div class="input-group">
            <label>Ime</label>
            <input type="text" name="fname">
        </div>

        <div class="input-group">
            <label>Prezime</label>
            <input type="text" name="lname">
        </div>
    
        <div class="input-group">
            <label>Email</label>
            <input type="text" name="email" echo $username;>
        </div>

        <div class="input-group">
            <label>Lozinka</label>
            <input type="password" name="password_1">
        </div>

        <div class="input-group">
            <label>Lozinka ponovo</label>
            <input type="password" name="password_2">
        </div>

        <div class="input-group">
            <label>Adresa</label>
            <input type="text" name="address">
        </div>

        <div class="input-group">
            <button type="submit" name="register" calss="btn">Registracija</button>
        </div>

        <p>
            Već si član ? <a href="login.php">Sign in</a>
        </p>

    </form>
</body>
</html>