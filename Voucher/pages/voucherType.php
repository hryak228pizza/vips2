<?php


$voucher_type = ["круиз" => [2000, "На большом теплоходе  ..."],
    "сафари" => [3000, "В жаркой пустыне ..."],
    "гастротур" => [1000, "Этнические рестораны ..."]];

$meal_type = ["завтрак" => [10, "с 8-00 до 10-00"],
    "ужин" => [20, "с 19-00 до 22-00"],
    "пансион" => [50, "добавляется обед с 13-00 до 15-00"]];

$countries = [
    "круиз" => [["Италия", 200], ["Хорватия", 100], ["Швеция", 300]],
    "сафари" => [["Кения", 500], ["Марокко", 300], ["ЮАР", 800]],
    "гастротур" => [["Дания", 50], ["Норвегия", 100], ["Франция", 80]]
];

$services = [
    "круиз" => [["Сауна", 50], ["Бассейн", 100], ["Бар", 200]],
    "сафари" => [["Кормление животных", 100], ["Фотоохота", 50], ["Разделывание туши", 200]],
    "гастротур" => [["Местный рынок", 50], ["Приготовление еды", 200], ["Виноферма", 100]]
];


if (isset($_COOKIE["auth_cookie"])) {
    echo '<select form="order-form" name="type">
            <option value="">Выберите тип путевки</option>';
    
    foreach ($voucher_type as $type => $value_arr) {
        $selected = ($type == "круиз") ? 'selected' : '';
        echo '<option ' . $selected . ' value="' . $type . '#'.$value_arr[0]. '">' . $type . " " . $value_arr[0] . " " . $value_arr[1] . '</option>';

    }
    echo '</select>';
}
?>