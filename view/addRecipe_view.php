<!doctype html>
<html>
  <head>
    <title>Add Recipe</title>
    <h1> Add Recipe </h1>
  </head>
  <body>
    <main>
    
        <form action="addRecipe.php" method="post">
        <p>Title: <input name="title"/></p>
        <p><textarea cols="30" rows="10" name="description" placeholder="Description"></textarea></p>
        <p><textarea cols="30" rows="10" name="ingredientList" placeholder="(amount) Ingredient, 
                                                                  (amount) Ingredient,..."></textarea></p>

        <p><textarea name="instructions" placeholder="Instructions"></textarea></p>
        <p>Cooking Time: <input name="time"/></p>

        <p>Diet Restrictions? (Leave blank if none)<br/>
        <input type="checkbox" name="restrictions[]" value="Gluten-free"/> Gluten-free
        <input type="checkbox" name="restrictions[]" value="Vegetarian"/> Vegetarian
        <input type="checkbox" name="restrictions[]" value="Vegan"/> Vegan<br/>
        <input type="checkbox" name="restrictions[]" value="Dairy-free"/> Dairy-free
        <input type="checkbox" name="restrictions[]" value="Kosher"/> Kosher</P>

        <p>keywords (Pick at least one)<br/>
        <input type="checkbox" name="keywords[]" value="Breakfast"/> Breakfast
        <input type="checkbox" name="keywords[]" value="Dessert"/> Dessert
        <input type="checkbox" name="keywords[]" value="Dinner"/> Dinner<br/>
        <input type="checkbox" name="keywords[]" value="Freezable"/> Freezable
        <input type="checkbox" name="keywords[]" value="Healthy"/> Healthy<br/>
        <input type="checkbox" name="keywords[]" value="Lunch"/> Lunch
        <input type="checkbox" name="keywords[]" value="Quick"/> Quick<br/>
        <input type="checkbox" name="keywords[]" value="Snack"/> Snack</p><br/>

        <p>Recipe box options<br/>
        Is a recipe box available? <input type="radio" name="choice" value="1"/>Yes
                                <input type="radio" name="choice" value="0"/>No<br/>
        Cost <input name="cost"/>                 
        </p>


        <br/><input type="submit" value="Add"/>
        </form>
    </main>
    <a href="home.php">Or go back to recipe list</a>
  </body>
</html>