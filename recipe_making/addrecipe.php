<?php
// ingredients_form.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Recipe Ingredients</title>
</head>
<body>
    <h1>Upload Recipe Ingredients</h1>
    <form action="instructions_form.php" method="post">
        <label for="recipe_name">Recipe Name:</label>
        <input type="text" id="recipe_name" name="recipe_name" required><br><br>

        <label for="ingredients">Ingredients (one per line):</label><br>
        <textarea id="ingredients" name="ingredients" rows="10" cols="50" required></textarea><br><br>

        <button type="submit">Next</button>
    </form>
</body>
</html>

<?php
// instructions_form.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $_SESSION['recipe_name'] = $_POST['recipe_name'];
    $_SESSION['ingredients'] = $_POST['ingredients'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Recipe Instructions</title>
</head>
<body>
    <h1>Upload Recipe Instructions</h1>
    <form action="save_recipe.php" method="post" enctype="multipart/form-data">
        <p><strong>Recipe Name:</strong> <?php echo htmlspecialchars($_SESSION['recipe_name'] ?? ''); ?></p>
        <p><strong>Ingredients:</strong></p>
        <pre><?php echo htmlspecialchars($_SESSION['ingredients'] ?? ''); ?></pre>

        <div id="instructions">
            <div>
                <label for="step_1">Step 1:</label><br>
                <textarea id="step_1" name="steps[]" rows="4" cols="50" required></textarea><br>
                <label for="image_1">Image:</label>
                <input type="file" id="image_1" name="images[]" accept="image/*"><br><br>
            </div>
        </div>

        <button type="button" onclick="addStep()">Add Another Step</button><br><br>
        <button type="submit">Submit Recipe</button>
    </form>

    <script>
        let stepCount = 1;

        function addStep() {
            stepCount++;
            const instructionsDiv = document.getElementById('instructions');
            const newStep = document.createElement('div');
            newStep.innerHTML = `
                <label for="step_${stepCount}">Step ${stepCount}:</label><br>
                <textarea id="step_${stepCount}" name="steps[]" rows="4" cols="50" required></textarea><br>
                <label for="image_${stepCount}">Image:</label>
                <input type="file" id="image_${stepCount}" name="images[]" accept="image/*"><br><br>
            `;
            instructionsDiv.appendChild(newStep);
        }
    </script>
</body>
</html>

<?php
// save_recipe.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipeName = $_SESSION['recipe_name'] ?? '';
    $ingredients = $_SESSION['ingredients'] ?? '';
    $steps = $_POST['steps'];
    $uploadedImages = $_FILES['images'];

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir);
    }

    $imagePaths = [];
    for ($i = 0; $i < count($uploadedImages['name']); $i++) {
        if ($uploadedImages['error'][$i] === UPLOAD_ERR_OK) {
            $tmpName = $uploadedImages['tmp_name'][$i];
            $fileName = basename($uploadedImages['name'][$i]);
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($tmpName, $targetPath)) {
                $imagePaths[] = $targetPath;
            }
        }
    }

    // Save recipe to a file (or database, if desired)
    $recipeFile = fopen($uploadDir . 'recipe_' . time() . '.txt', 'w');
    fwrite($recipeFile, "Recipe Name: $recipeName\n\n");
    fwrite($recipeFile, "Ingredients:\n$ingredients\n\n");
    fwrite($recipeFile, "Instructions:\n");

    foreach ($steps as $index => $step) {
        fwrite($recipeFile, "Step " . ($index + 1) . ": $step\n");
        if (isset($imagePaths[$index])) {
            fwrite($recipeFile, "Image: " . $imagePaths[$index] . "\n");
        }
        fwrite($recipeFile, "\n");
    }

    fclose($recipeFile);

    echo "<h1>Recipe Uploaded Successfully!</h1>";
    echo "<a href='ingredients_form.php'>Upload Another Recipe</a>";
}
?>
