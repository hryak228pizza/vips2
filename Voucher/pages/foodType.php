<?php

$meal_type = [
    "завтрак" => [10, "с 8-00 до 10-00"],
    "ужин" => [20, "с 19-00 до 22-00"],
    "пансион" => [50, "добавляется обед с 13-00 до 15-00"]
];


if (isset($_COOKIE["auth_cookie"])) {

    echo '<form id="order-form" method="POST" action="bill.php">';

    foreach ($meal_type as $food => $data) {
        echo '<input type="radio" name="food" value="' . $food . '#' . $data[0] . '"> ' . $food . '. К стоимости +' . $data[0] . ' (' . $data[1] . ')<br>';
    }
    
    echo '</form>';
}
?>
