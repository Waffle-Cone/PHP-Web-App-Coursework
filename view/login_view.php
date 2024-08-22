<!DOCTYPE html>
<head>
    <title>login</title>
    <h1> Login or Sign Up </h1>
</head>
<body>
    <?php if ($message): ?>
        <h4><?=$message?></h4>
    <?php endif ?>
    
    <?php if (empty($result)):?>
    <form method="post" action="login.php">
        <p>Username: <input name="username"/></p>
        <p>Password: <input name="password" type="password"/></p>
        <br/><input type="submit" value="Login"/>
    </form>
    <?php endif ?>

    <br><a href="home.php">Return to Home</a>
</body>
</html>