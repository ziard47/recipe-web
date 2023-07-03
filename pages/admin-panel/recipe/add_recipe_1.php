<?php
  require("../validate_admin.php");
 ?>

<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org" >
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta neme="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Admin</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>

    <input type="checkbox" name="" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="lab la-accusoft"></span> <span>Recipe Admin</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
            <li>
                    <a href="../dashboard.php"><span class="las la-igloo"></span>
                        <span>Dashboard</span></a>
                </li>

                <li>
                    <a href="../recipes.php" class="active"><span class="las la-pizza-slice"></span>
                        <span>Recipes</span></a>
                </li>

                <li>
                    <a href="../revision.php"><span class="las la-wine-glass"></span>
                        <span>Recipe Revision</span></a>
                </li>

                <li>
                    <a href="../users.php"><span class="las la-users"></span>
                        <span>Users</span></a>
                </li>

                
                <li>
                    <a href="../coupens.php"><span class="las la-ticket-alt"></span>
                        <span>Coupens</span></a>
                </li>

            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="span las la-bars"></span>
                </label>
                Recipe
            </h2>

            <div class="search-wrapper">
                <span class="span las la-search"></span>
                <input type="search" placeholder="search here" />
            </div>

            <div class="user-wrapper">
                <div>
                <a href="../../logout.php"><h4 style="color: #2885DA;">Logout</h4></a>
                </div>
            </div>
        </header>

        <main>
            <form class="form" action="add_recipe_2.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input class="form-control" type="text" id="title" name="title" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="preparation_time">Preparation Time (minutes):</label>
                    <input class="form-control" type="number" id="preparation_time" name="preparation_time" required>
                </div>

                <div class="form-group">
                    <label for="cooking_time">Cooking Time (minutes):</label>
                    <input class="form-control" type="number" id="cooking_time" name="cooking_time" required>
                </div>

                <div class="form-group">
                    <label for="servings">Servings:</label>
                    <input class="form-control" type="number" id="servings" name="servings" required>
                </div>

                <div class="form-group">
                    <label for="servings">Picture:</label>
                    <input type="file" class="form-control-file" id="picture" name="picture" value=""><br><br>
                </div>

                <h5>Ingredients:</h5>
                <div id="ingredients">
                    <div class="form-row">
                        <div class="col">
                            <input class="form-control" type="text" name="ingredient_name[]" placeholder="Ingredient Name" required>
                        </div>
                        <div class="col">
                            <input class="form-control" type="text" name="quantity[]" placeholder="Quantity" required>
                        </div>
                        <div class="col">
                            <input class="form-control" type="text" name="unit[]" placeholder="Unit">
                        </div><br><br>
                    </div>
                </div>
                <button type="button" class="btn btn-primary mb-2" onclick="addIngredient()">Add Ingredient</button><br><br>

                <h5>Steps:</h5>
                <div id="steps">
                    <textarea class="form-control" name="step_description[]" placeholder="Step Description" required></textarea><br>
                </div>
                <button type="button" class="btn btn-primary mb-2" onclick="addStep()">Add Step</button><br><br>

                <button type="submit" class="btn btn-primary mb-2" name="submit" id="submit">Add Recipe</button>
                <button type="reset" class="btn btn-danger mb-2" name="reset" id="reset">Clear</button>
            </form>
        </main>
    </div>

    <script>
        function addIngredient() {
            var ingredientDiv = document.getElementById("ingredients");
            var newIngredient = document.createElement("div");
            newIngredient.innerHTML = `
                <div class="form-row">
                    <div class="col">
                        <input class="form-control" type="text" name="ingredient_name[]" placeholder="Ingredient Name" required>
                    </div>
                    <div class="col">
                        <input class="form-control" type="text" name="quantity[]" placeholder="Quantity" required>
                    </div>
                    <div class="col">
                        <input class="form-control" type="text" name="unit[]" placeholder="Unit" required>
                    </div><br><br>
                </div>
            `;
            ingredientDiv.appendChild(newIngredient);
        }

        function addStep() {
            var stepDiv = document.getElementById("steps");
            var newStep = document.createElement("div");
            newStep.innerHTML = `
                <textarea class="form-control" name="step_description[]" placeholder="Step Description" required></textarea><br>
            `;
            stepDiv.appendChild(newStep);
        }
    </script>
</body>
</html>