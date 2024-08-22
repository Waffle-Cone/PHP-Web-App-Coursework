<!DOCTYPE html>
<head>
    <title>checkout</title>
</head>
<body>
    <?php if($isCheckedOut ==false): ?>
        <h1> Checkout </h1>
            <?php else: ?>
                <h1> Checked out! </h1>
                <h2> Your order has been placed </h2>
    <?php endif ?>

    <?php if($isCheckedOut == false): ?>
        <form action="checkout.php" method="post">
            <p>First name: <input name="firstName"/></p>
            <p>Last name: <input name="lastName"/></p>
            <p>Email: <input name="email"/></p>
            <p>Address:</p><textarea name="address"></textarea></br>
            <p>Total Cost: <?= $price ?></p>
            <input type="submit" value="Order"/>
        </form>
    <?php endif ?>

        <?php if($account->isAdmin==1): ?>
    <p> this is your address <?= $account->customer->address ?></p>
        <?php endif ?>

    <br><a href="basket.php">Return to Basket</a></br>
    <br><a href="home.php">Return to Home</a>
</body>
</html>