<?php
// ------ DATABASE CONNECTION ------ //

$db_Name = "db_k2023556";
$db_userName = "k2023556";
$db_password = "beisuoya";
$db_server = "localhost";


$pdo = new PDO("mysql:host=$db_server;dbname=$db_Name",
                "$db_userName",
                "$db_password",
                [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
                
//Recipe functions
    // --- prepare statement template--- //

   function sqlStatement($sql,$questionMark,$class) //use this to make select statements
   {
    global $pdo;
    $statement = $pdo->prepare("$sql");
    $statement->execute([$questionMark]);
    $results= $statement->fetchALL(PDO::FETCH_CLASS,$class);

    return $results;
    
   }


    // --- assign function ---//

        /**
         * takes an array of recipes
         * pdo searches to get list of all ingredients,keywords,restrictions and makes them objects
         * assigns to recipe
         */

    function assignEverything($recipes) 
        {
            foreach($recipes as $recipe)
            {
            $assignIngredients= sqlStatement("SELECT Ingredients.ingredient
                                                FROM Recipes,RecipeIngredients,Ingredients
                                                Where Recipes.recipe_ID=RecipeIngredients.recipe_ID 
                                                AND RecipeIngredients.ingredient_ID=Ingredients.ingredient_ID
                                                AND Recipes.recipeTitle= ?",
                    "$recipe->recipeTitle","Ingredient");
                foreach($assignIngredients as $i)
                {
                $recipe->addIngredient($i);
                }

            $assignKeywords = sqlStatement("SELECT Keywords.keyword
                                            FROM Recipes,RecipeKeywords,Keywords
                                            WHERE Recipes.recipe_ID=RecipeKeywords.recipe_ID 
                                            AND RecipeKeywords.keyword_ID=Keywords.keyword_ID
                                            AND Recipes.recipeTitle= ? ",
                                        "$recipe->recipeTitle","Keyword");
                foreach($assignKeywords as $k )
                {
                    $recipe->addKeyword($k);
                }

                $assignRestrictions = sqlStatement("SELECT DietaryRestrictions.restriction
                                                FROM Recipes,RecipeRestrictions,DietaryRestrictions
                                                WHERE Recipes.recipe_ID=RecipeRestrictions.recipe_ID
                                                AND RecipeRestrictions.restriction_ID=DietaryRestrictions.restriction_ID
                                                AND Recipes.recipeTitle= ?",
                                            "$recipe->recipeTitle","DietaryRestriction");
                foreach($assignRestrictions as $r)
                {
                    $recipe->addRestriction($r);
                }
            }
        }

    

    //---- Recipe Access functions ------//

        function getAllRecipes() // Select* query
        {
            $results= sqlStatement("SELECT * FROM Recipes","","Recipe");
            assignEverything($results);
            return $results;

        }

        function getRecipeByTitle($title)
        {
            if($title==""||$title== " ")
            {
                return getAllRecipes();
            }

            $results = sqlStatement("SELECT *
                                    FROM Recipes
                                    WHERE recipeTitle LIKE ?",
                                "%".$title."%","Recipe");
            assignEverything($results);
            return $results;
        }

        function getRecipeByText($text)
        {
            if($text==""||$text==" ")
            {
                return getAllRecipes();
            }

            $results = sqlStatement("SELECT *
                                    FROM Recipes
                                    WHERE recipeText LIKE ?",
                                "%".$text."%","Recipe");
            assignEverything($results);
            return $results;
        }

        function getRecipeByIngredient($ingredient) // Select those recipes where the inputed ingredients are included 
        {
            if ($ingredient ==""|| $ingredient == " " )
            {
                return getAllRecipes();
            }
            
            $results = sqlStatement("SELECT Recipes.recipeTitle,Recipes.recipeShort,Recipes.recipeText,Recipes.ingredientText,Recipes.cookingTime,Recipes.isBox,Recipes.cost
                                    FROM Recipes,RecipeIngredients,Ingredients
                                    WHERE Recipes.recipe_ID=RecipeIngredients.recipe_ID
                                    AND RecipeIngredients.ingredient_ID=Ingredients.ingredient_ID
                                    AND Ingredients.ingredient =?",
                                "$ingredient","Recipe");
            assignEverything($results);
            return $results;

            
        } 


        function getRecipeByDiet($diet) //Selcet recpes where dietary contraint is = to inputed
        {
            if ( $diet =="" || $diet ==" ")
            {
                return getAllRecipes();
            }

            $results = sqlStatement("SELECT Recipes.recipeTitle,Recipes.recipeShort,Recipes.recipeText,Recipes.ingredientText,Recipes.cookingTime,Recipes.isBox,Recipes.cost
                                    FROM Recipes,RecipeRestrictions,DietaryRestrictions
                                    WHERE Recipes.recipe_ID=RecipeRestrictions.recipe_ID
                                    AND RecipeRestrictions.restriction_ID=DietaryRestrictions.restriction_ID
                                    AND DietaryRestrictions.restriction LIKE ?",
                                "%".$diet."%","Recipe");
            assignEverything($results);
            return $results;
        }

        function getRecipeByKeyword($keyword) //Select recipes which include given keyword
        {
            if ( $keyword =="" || $keyword ==" ")
            {
                return getAllRecipes();
            }
            
            $results = sqlStatement("SELECT Recipes.recipeTitle,Recipes.recipeShort,Recipes.recipeText,Recipes.ingredientText,Recipes.cookingTime,Recipes.isBox,Recipes.cost
                                    FROM Recipes,RecipeKeywords,Keywords
                                    WHERE Recipes.recipe_ID=RecipeKeywords.recipe_ID
                                    AND RecipeKeywords.keyword_ID=Keywords.keyword_ID
                                    AND Keywords.keyword LIKE ?",
                                "%".$keyword."%","Recipe");
            assignEverything($results);
            return $results;

        }



        function getRecipeByCookingTime($cookingTime) //Select those recipes where cooking time = to what is inputed
        {
            if ( $cookingTime =="" || $cookingTime ==" ")
            {
                return getAllRecipes();
            }
            $results = sqlStatement("SELECT Recipes.recipeTitle,Recipes.recipeShort,Recipes.recipeText,Recipes.ingredientText,Recipes.cookingTime,Recipes.isBox,Recipes.cost
                                    FROM Recipes
                                    WHERE Recipes.cookingTime =?",
                                "$cookingTime","Recipe");
            assignEverything($results);
            return $results;
        }

    //AJAX stuff//
    function ajaxSqlStatement($sql,$execute)
    {
        global $pdo;
        $statement = $pdo->prepare($sql);
        $statement->execute([$execute]);
        $results = $statement->fetchAll(PDO::FETCH_COLUMN,0);
         return $results;  
    }

    function getRecipeByStartOfTitle($partialTitle)
    {
        $recipes = ajaxSqlStatement("SELECT DISTINCT recipeTitle 
                                    FROM Recipes
                                    WHERE recipeTitle like ?",
                                    $partialTitle."%");
        return $recipes;
    }

    function getRecipeByStartOfText($partialText)
    {
        $recipes = ajaxSqlStatement("SELECT DISTINCT recipeTitle 
                                    FROM Recipes
                                    WHERE recipeText like ?",
                                    "%".$partialText."%");
        return $recipes;
    }
    function getRecipeByStartOfIngredient($partialIngredient)
    {
        $recipes = ajaxSqlStatement("SELECT DISTINCT Recipes.recipeTitle
                                    FROM Recipes,RecipeIngredients,Ingredients
                                    WHERE Recipes.recipe_ID=RecipeIngredients.recipe_ID
                                    AND RecipeIngredients.ingredient_ID=Ingredients.ingredient_ID
                                    AND Ingredients.ingredient LIKE ?",
                                    $partialIngredient."%");
        return $recipes;

    }
    function getRecipeByStartOfKeyword($partialKeyword)
    {
        $recipes = ajaxSqlStatement("SELECT DISTINCT Recipes.recipeTitle
                                    FROM Recipes,RecipeKeywords,Keywords
                                    WHERE Recipes.recipe_ID=RecipeKeywords.recipe_ID
                                    AND RecipeKeywords.keyword_ID=Keywords.keyword_ID
                                    AND Keywords.keyword LIKE ?",
                                    $partialKeyword."%");
        return $recipes;
    }

    function getRecipeByStartOfDiet($partialDiet)
    {
        $recipes = ajaxSqlStatement("SELECT DISTINCT Recipes.recipeTitle
                                    FROM Recipes,RecipeRestrictions,DietaryRestrictions
                                    WHERE Recipes.recipe_ID=RecipeRestrictions.recipe_ID
                                    AND RecipeRestrictions.restriction_ID=DietaryRestrictions.restriction_ID
                                    AND DietaryRestrictions.restriction LIKE ?",
                                    $partialDiet."%");
        return $recipes;
    }
    function getRecipeByStartOfTime($partialTime)
    {
        $recipe = ajaxSqlStatement("SELECT DISTINCT recipeTitle
                                    FROM Recipes 
                                    WHERE cookingTime LIKE ?",
                                    $partialTime."%");
        return $recipe;
    }
    








        //--- Stuff for the add recipe page ---///

        function getAllIngredients()
        {
            $results = sqlStatement("SELECT Ingredients.ingredient
                                    FROM Ingredients",
                                "","Ingredient");
            return $results;
        }

        function getIngredientByName($name)
        {
            $results = sqlStatement("SELECT Ingredients.ingredient_ID, Ingredients.ingredient
                                    FROM Ingredients
                                    WHERE Ingredients.ingredient = ?",
                                    "$name","Ingredient");
            return $results;
        }

        function getKeywordIdByName($name)
        {
            $results = sqlStatement("SELECT keyword_ID
                                    FROM Keywords
                                    WHERE Keyword = ?",
                                    "$name","Keyword");
            return $results[0]->keyword_ID; // to get the id out of array
        }

        function getRestrictionIdByName($name)
        {
            $results = sqlStatement("SELECT restriction_ID
                                    FROM DietaryRestrictions
                                    WHERE restriction = ?",
                                    "$name","DietaryRestriction");
            return $results[0]->restriction_ID; // to get the id out of array
        }




    //~START~STORING FUNCTIONS

            function addNewRecipe($recipe)
            {
            
                if (getRecipeByTitle($recipe->recipeTitle))
                {
                    return $status ="This recipe exists";
                }
                else
                {
                Global $pdo;
            
                    $statement = $pdo->prepare("INSERT INTO Recipes (recipeTitle,recipeShort,recipeText,ingredientText,cookingTime,isBox,cost)
                                            VALUES (:recipeTitle,:recipeShort,:recipeText,:ingredientText,:cookingTime,:isBox,:cost)
                                            ");

                    $statement->bindValue(":recipeTitle",$recipe->recipeTitle);
                    $statement->bindValue(":recipeShort",$recipe->recipeShort);
                    $statement->bindValue(":recipeText",$recipe->recipeText);
                    $statement->bindValue(":ingredientText",$recipe->ingredientText);
                    $statement->bindValue(":cookingTime",$recipe->cookingTime);
                    $statement->bindValue(":isBox",$recipe->isBox);
                    $statement->bindValue(":cost",$recipe->cost);

                    $statement->execute();

                    $newRecipeId = $pdo->lastInsertId(); // need this later to make sure everything stays linked between tables
            
                    foreach($recipe->ingredients as $ingredient)
                    {
                        if(getIngredientByName($ingredient))
                        {
                            $recipeIngredientID = getIngredientByName($ingredient)[0]->ingredient_ID; //if the ingredient already exists please give me its id

                            //insterting ingredeint with the new recipe into the joint table

                            $statement2 =$pdo->prepare("INSERT INTO RecipeIngredients (recipe_ID, ingredient_ID) 
                                                        VALUES (:recipe_ID,:ingredient_ID)
                                                        ");
                            $statement2->bindValue(":recipe_ID",$newRecipeId);
                            $statement2->bindValue(":ingredient_ID",$recipeIngredientID);
                            $statement2->execute();

                        }
                        else //if this ingredeint please do this
                        {
                            //adding new ingredeint to database 
                            $statement3 =$pdo->prepare("INSERT INTO Ingredients (ingredient) 
                                                        VALUES (:ingredient)
                                                        ");
                            $statement3->bindValue(":ingredient",$ingredient);
                            $statement3->execute();

                            $newIngredientId = $pdo->lastInsertId(); //obtaining the new id allocated to this new ingredient


                            //using both the new recipe id and this new ingredient id we can join/link them in the RecipeIngredeint table
                        
                            $statement2 =$pdo->prepare("INSERT INTO RecipeIngredients (recipe_ID,ingredient_ID) 
                                                        VALUES (:recipe_ID,:ingredient_ID)
                                                        ");
                            $statement2->bindValue(":recipe_ID",$newRecipeId);
                            $statement2->bindValue(":ingredient_ID",$newIngredientId);
                            $statement2->execute();

                        
                        }
                    }   
                    
                    foreach($recipe->keywords as $keyword) // keywords prexist and so no new ones need to be made
                    {
                        $keywordId = getKeywordIdByName($keyword);

                        $statement4 =$pdo->prepare("INSERT INTO RecipeKeywords (recipe_ID,Keyword_ID) 
                                                    VALUES (:recipe_ID,:keyword_ID)
                                                    ");

                            $statement4->bindValue(":recipe_ID",$newRecipeId);
                            $statement4->bindValue(":keyword_ID",$keywordId);
                            $statement4->execute();
                    }

                    foreach($recipe->dietaryRestrictions as $restriction)
                    {
                        $restrictionId = getRestrictionIdByName($restriction);

                        $statement5 =$pdo->prepare("INSERT INTO RecipeRestrictions (recipe_ID,restriction_ID) 
                                                    VALUES (:recipe_ID,:restriction_ID)
                                                    ");

                            $statement5->bindValue(":recipe_ID",$newRecipeId);
                            $statement5->bindValue(":restriction_ID",$restrictionId);
                            $statement5->execute();
                    }
                    return $status = "new Recipe added"; //with hopefully no errors 
                }

            }
                              
            function updateRecipe()
            {

            }  

    //~END~STORING FUNCTIONS


//account and customer stuff
        function findAccounts($accountUserame,$accountPassword)
        {
            /*$results = sqlStatement("SELECT username,passcode
                                    FROM Accounts
                                    WHERE username = ? AND passcode = ?",
                                    "['$accountUserame','$accountPassword']","Account");*/
            global $pdo;
            $statement = $pdo->prepare("SELECT username,passcode,isAdmin
                                        FROM Accounts
                                        WHERE BINARY username = ? AND BINARY passcode = ?");
            $statement->execute([$accountUserame,$accountPassword]);
            $results= $statement->fetchALL(PDO::FETCH_CLASS,"Account");

            if($results!=null)
            {
                $customer = sqlStatement("SELECT firstName, lastName, email, Customers.address
                                        FROM Customers, Accounts
                                        WHERE Accounts.customer_ID = Customers.customer_ID
                                        AND Accounts.username = ?",
                                        "$accountUserame","Customer");
                
                $results[0]->customer = $customer[0];
                $results[0]->customer->hasAccount = true;
                return $results;
                
            }  
            
        }

        function orderRecipes($customerInfo,$basket) 
        {
            Global $pdo;

            foreach($basket as $lists)
            {
                foreach($lists as $item)
                {
                    /*$statement = $pdo->prepare("INSERT INTO RecipeOrder (recipe_ID)
                                                VALUES (:recipe_ID)
                                            ");

                    $statement2->bindValue(":order_ID",$newRecipeId);
                    $statement2->bindValue(":ingredient_ID",$recipeIngredientID);
                    $statement2->execute();*/
                }
            }
        }

?>
