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
    
    if (isset($_POST["next"])) {
        $_SESSION["type"] = $_POST["type"];
        $_SESSION["food"] = $_POST["food"];
        $_SESSION["name"] = $_POST["name"];
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["phone"] = $_POST["phone"];

        //echo explode($_POST["type"], "#")[0];
        //echo explode("#", $_POST["type"])[0];

        $country_data = $countries[explode("#", $_POST["type"])[0]];
        
        for ($i = 0; $i < count($country_data); $i++) {
            $selected = ($country_data[$i][0] == $country_data[0][0]) ? 'checked' : '';
            echo '<input type="radio" form="bill-form" name="radioButtons" ' . $selected . ' value="' . $country_data[$i][0]."#".$country_data[$i][1].'">' . $country_data[$i][0] . ". К стоимости +" . $country_data[$i][1] . '<br>';
        }
    }
}

?>