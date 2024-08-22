<!doctype html>
<html>
<head>
  <title> Basket</title>
</head>
<body>
  <h1>Your basket</h1>
    <table>
        <thead>
            <tr>
                <th>Recipe title</th>
                <th>Cost</th>
            </tr>
        </thead>
          <tbody>
            <?php foreach ($basket as $item): ?>
              <tr>
                      <?php foreach ($item as $recipe): ?>
                          <td><?= $recipe->recipeTitle ?></td>
                          <td><?= $recipe->cost ?></td>     
                      <?php endforeach ?>
              </tr>
            <?php endforeach ?>
          </tbody>
    </table>

    <br><p>Total Cost: <?= $price ?></p>
    <?php if(sizeof($basket)!=0): ?>
      <a href="checkout.php">Checkout</a><br/>
    <?php endif ?>
    <br><a href="home.php">Return to Home</a>
  </body>
</html>

