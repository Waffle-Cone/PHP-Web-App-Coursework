$(document).ready(function()
{
    var searchOptions= "title";// holds the search options.

    $("select[name=coolSearchOptions]").change(function()
    {
        searchOptions = $(this).val();
        console.log(searchOptions); 
    });
    
    
 
    $("div#coolSearch div.results").hide();
    $("div#coolSearch input").keyup(function()
    {
        var search = $("div#coolSearch input").val().trim();
        //console.log(search);
        if (search != "") 
        {
            if(searchOptions == "title")
            {
                $.get("getRecipe_service.php?title="+search,autoCompletecallback);
            }
            else if(searchOptions == "text")
            {
                $.get("getRecipe_service.php?text="+search,autoCompletecallback);
            }
            else if(searchOptions == "ingredient")
            {
                $.get("getRecipe_service.php?ingredient="+search,autoCompletecallback);
            }
            else if(searchOptions == "keyword")
            {
                $.get("getRecipe_service.php?keyword="+search,autoCompletecallback);
            }
            else if(searchOptions == "diet")
            {
                $.get("getRecipe_service.php?diet="+search,autoCompletecallback);
            }
            else if(searchOptions == "time")
            {
                $.get("getRecipe_service.php?time="+search,autoCompletecallback);
            }      
        }
        else // if search IS empty
        {
            $("div#coolSearch div.results").hide();
        }
    });

    $("input#coolSearchButton").click(function()
    {
        //console.log("clicked");

        var search= $("input[name=search]").val().trim();
        console.log(search);
        searchCallback("hello");
        $.get("getFullRecipe_service.php?title="+search,searchCallback);

    });
    

});

    function searchCallback(recipes)
    {
        console.log(recipes);
        $("table.results tbody").empty();
       
        for(var i=0;i<recipes.length;i++)
        {
            var recipe = recipes[i];
        }
    }



    

function autoCompletecallback(resultsText)
    {
        console.log(resultsText);
        $("div#coolSearch div.results").empty();
        for (var i = 0; i < resultsText.length; i++)
        {
        var result = $("<div class='result'>"+resultsText[i]+"</div>");
        result.click(function()
        {
                $("div#coolSearch div.results").hide();
                $("input[name=searchRecipes]").val($(this).text());
                $("form").get(0).submit();
        });
        $("div#coolSearch div.results").append(result);
        }
        if (resultsText.length == 0)
        {
            $("div#coolSearch div.results").hide();
        }
        else
        {
            $("div#coolSearch div.results").show();
        }

    }