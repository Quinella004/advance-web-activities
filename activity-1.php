<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vending Machine</title>
</head>
<body>

    <?php 
        $drinksChoices = [
            'Coke' => 15,
            'Sprite' => 20,
            'Royal' => 20,
            'Pepsi' => 15,
            'Mountain Dew' => 20
        ];
        $drinksSizess = [
            'Regular' => 0,
            'Up-Size' => 5,
            'Jumbo' => 10
        ];
    ?>

    <form method="post">
        <h1>Vending Machine</h1>

        <fieldset>
            <legend>Products:</legend>
            <?php
                foreach ($drinksChoices as $drinkName => $price) {
                    echo '<input type="checkbox" name="drinksChoices[]" id="drink_' . htmlspecialchars($drinkName) . '" value="' . htmlspecialchars($drinkName) . '">';
                    echo '<label for="drink_' . htmlspecialchars($drinkName) . '"> ' . htmlspecialchars($drinkName) . ' - ₱' . htmlspecialchars($price) . '</label><br>';
                }
            ?>
        </fieldset>

        <fieldset>
            <legend>Options:</legend>
            <label for="drinksSizes">Size:</label>
            <select name="drinksSizes" id="drinksSizes">
                <?php 
                    foreach ($drinksSizess as $sizeName => $additionalCost) {
                        $costText = $sizeName !== 'Regular' ? " (add ₱$additionalCost)" : "";
                        echo '<option value="' . htmlspecialchars($sizeName) . '">' . htmlspecialchars($sizeName) . $costText . '</option>';
                    }
                ?>
            </select>

            <label for="numberOfQuantity">Quantity:</label>
            <input type="number" name="numberOfQuantity" id="numberOfQuantity" value="1">
            <button type="submit" name="btnCheck">Check Out</button>
        </fieldset>
    </form>

    <?php
        if (isset($_POST['btnCheck'])) {
            $selectedDrinks = $_POST['drinksChoices'] ?? [];
            
            if (empty($selectedDrinks)) {
                echo "<h1>Please select at least one drink.</h1>";
            } else {
                $selectedSize = $_POST['drinksSizes'] ?? 'Regular';
                $selectedQuantity = (int) ($_POST['numberOfQuantity'] ?? 1); 
                $totalCost = 0;
                $totalItems = 0;
                ?>
                <hr>
                <h1>Order Summary:</h1>
                <ul>
                    <?php foreach ($selectedDrinks as $drink) { 
                        $drinkCost = $drinksChoices[$drink] ?? 0;
                        $sizeCost = $drinksSizess[$selectedSize] ?? 0;
                        $costForThisDrink = ($drinkCost + $sizeCost) * $selectedQuantity;
                        $totalCost += $costForThisDrink;
                        $totalItems += $selectedQuantity;
                    ?>
                        <li>
                            <?php echo "$selectedQuantity piece(s) of " . htmlspecialchars($drink) . " costing ₱" . number_format($costForThisDrink, 2); ?>
                        </li>
                    <?php } ?>
                </ul>
                <strong>Total Items: <?php echo $totalItems; ?></strong><br>
                <strong>Grand Total: ₱<?php echo number_format($totalCost, 2); ?></strong>
            <?php
            }
        }
    ?>

</body>
</html>
