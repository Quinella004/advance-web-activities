<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peys App</title>
</head>
<body>
    <h1>Peys App</h1>
    <form method="post">
        <div>
            <label for="photoSize">Select Photo Size: </label>
            <input type="range" name="photoSize" id="photoSize">
        </div>
        <div>
            <label for="borderColor">Choose Border Color:</label>
            <input type="color" name="borderColor" id="borderColor" value="#000000">
        </div>
        <div>
            <button type="submit" name="processButton">Process</button>
        </div>
    </form>

    <?php 
    if (isset($_POST['processButton'])) { 
        $selectedBorderColor = $_POST['borderColor'] ?? '#000000';
        $selectedImgSize = $_POST['photoSize'] ?? 20;
        ?>
        <h2>Customized Photo:</h2>
        <img src="charles.png" alt="Custom Photo" width="<?php echo $selectedImgSize; ?>%" height="<?php echo $selectedImgSize; ?>%" style="border: 3px solid <?php echo $selectedBorderColor; ?>;">
    <?php 
    }
    ?>
</body>
</html>
