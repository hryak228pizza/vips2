<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = !empty($_POST['name']) ? htmlspecialchars($_POST['name']) . ', ' : '';
    $height = !empty($_POST['height']) ? (int)$_POST['height'] : 0;
    $age = isset($_POST['age']) ? $_POST['age'] : 'не указано';
    $athlete = isset($_POST['athlete']) ? 'спортсмен' : '';
    $vegan = isset($_POST['vegan']) ? 'веган' : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

    $weightMessage = '';
    $imagePath = '';

    if ($gender == 'женщина') {
        $weightMessage = 'Вы всегда прекрасны';
        $imagePath = 'img/height-2.png';
    } elseif ($gender == 'мужчина') {
        $optimalWeight = round($height * 0.7 - 50, 1);
        $weightMessage = "Оптимальный вес: {$optimalWeight} кг";
        $imagePath = 'img/height-1.png';
    } else {
        $weightMessage = 'Вес не имеется';
        $imagePath = 'img/height-3.png';
    }

    echo "<div style='display: flex; justify-content: space-between; align-items: flex-start; font-family: Arial, sans-serif; max-width: 500px; margin: auto; margin-top: 20px; padding: 20px; border: 1px solid #000; border-radius: 5px;'>";
    echo "<div style='flex: 1; margin-right: 20px;'>";
    echo "{$name}Ваш рост {$height} см <br> Возраст: {$age} <br> {$athlete} {$vegan}<br> {$weightMessage}";
    echo "</div>";
    echo "<img src='{$imagePath}' alt='Аватар' style='flex: 0 0 auto; height: 100px;'>";
    echo "</div>";
}
