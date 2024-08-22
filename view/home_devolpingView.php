<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="../view/css/home.css">
        <title>Recipes of Disaster</title>         
    </head>
        <header>
            <h1 id="siteName"> Recipes of Disaster </h1>
        </header>
                <body>
                    <form method="get" action="home.php">
                        <input name="searchRecipes" placeholder="Search"/>  
                        <input type="submit" value="Search by:"/><br>

                        <input type="radio" name="searchBy" value="ingredient"/>Ingredient
                        <input type="radio" name="searchBy" value="keyword"/>Keyword
                        <input type="radio" name="searchBy" value="diet"/>Diet
                    </form>
                    
                    <main>
                        <article>
                        <?php foreach($recipes as $recipe): ?>
                        <div class="recipe">
                            <div class="top">
                                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/2510825/courseImageCI4105.jpg" />
                            </div>
                            <div class="bottom">
                                <p class="recipeTitle"><?= $recipe->recipeTitle ?></p>
                                <p class="recipeShort"><?= $recipe->recipeShort ?></p>
                            </div>
                        </div>
                        <?php endforeach ?>
                        </article>
                    </main>
                </body>

    
</html>

