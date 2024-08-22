
<!doctype html>
<html>
    <head>
        <title>Recipes For Disaster</title>
        <link rel="stylesheet" type="text/css" href="../view/css/home.css"/>
        <script type="text/javascript" src="//code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../view/js/recipecode.js"></script>
    </head>
    <body>
        <div><h1>Recipes For Disaster</h1></div>

        <?php if($account->isAdmin==0): ?>
            <div><a href="login.php">Login</a></div>
            <?php else: ?>
                <div>Welcome! <?=$account->username?>
                    <form method="post" action="home.php">
                        <input type="submit" value="Log Out"/>
                    </form>
                </div></br>
        <?php endif ?>
        
        <div><?= count($basket) ?> box(s) added. <a href="../controller/basket.php">Show basket</a></div>
        
        <div>
            <form method="get" action="home.php">
                <input name="searchRecipes" placeholder="Search by Title or:"/>  
                <input type="submit" value="Search"/><br>

                <input type="radio" name="searchBy" value="text" />Recipe Text
                <input type="radio" name="searchBy" value="ingredient"/>Ingredient
                <input type="radio" name="searchBy" value="keyword"/>Keyword
                <input type="radio" name="searchBy" value="diet"/>Diet
                <input type="radio" name="searchBy" value="time"/>Cooking Time
            </form>
        </div>
           
            Please let this search work
            <div id= "coolSearch">
                <input name= "search" type="text" placeholder="Search" /> 
                <input id="coolSearchButton" type="button" value="Search"/>  
                    <Select name="coolSearchOptions" >
                        <option value="title">Name</option>
                        <option value="ingredient">Ingredient</option>
                        <option value="keyword">Keyword</option>
                        <option value="diet">Diet</option>
                        <option value="time">Cooking Time</option>
                    </Select>
                <div class="results">
                    <div class="result">data</div>
                </div>
                <br/>
            </div>

       <br>
       <Main>
    
            <table class="results">
            <thead>
                <tr>
                    <th>Recipe title</th>
                    <th>Ingredients</th>
                    <th>Restrictions</th>
                    <th>Keywords</th>
                    <th>isBox?</th>
                    <th>cost</th>   

                </tr>
            </thead>
            <tbody>
                <?php foreach($recipes as $recipe): ?>
                    <tr>
                        <td><?= $recipe->recipeTitle ?></td>
                        <td><?= sizeof($recipe->ingredients )?></td>
                        <td><?= sizeof($recipe->dietaryRestrictions )?></td>
                        <td><?= sizeof($recipe->keywords )?></td> 
                        <?php if ($recipe->isBox): ?>
                            <td><?= $recipe->isBox ?></td>
                            <td><?= $recipe->cost ?></td>
                            <td><a href="home.php?addToBasket=<?= $recipe->recipeTitle ?>">Add To Basket</a></td>
                        <?php endif ?>           
                    </tr>
                <?php endforeach ?>
            </tbody>
            </table>

        </main>
            <?php if($account->isAdmin== 1): ?>
            <br><div><a href="addRecipe.php" ?>Add Recipe</a></div> 
            <?php endif ?>              
    </body>
     
</html>