<?php include('server.php') ?>
<html>
<head>
<link href="style_reg.css" rel="stylesheet">
</head>
<body>
    <div class="header">
        <h2>Prijava</h2>
    </div>

    <form method="post" action="login.php">

        <?php echo display_error(); ?>

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username">
        </div>

        <div class="input-group">
            <label>Lozinka</label>
            <input type="text" name="password">
        </div>

        <div class="input-group">
            <button type="submit" name="login" calss="btn">Prijava</button>
        </div>

        <p>
            Nemaš račun ? <a href="register.php">Sign up</a>
        </p>

    </form>
</body>
</html>