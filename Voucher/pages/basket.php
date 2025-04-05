<?php
require_once '../vendor/autoload.php';
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

if (session_status() != 2) {
    session_start();
}

if (isset($_POST["next-bill"])) {
    $_SESSION["radioButtons"] = $_POST["radioButtons"];
    $_SESSION["checkbox"] = $_POST["checkbox"] ?? null;
    $_SESSION["days-count"] = $_POST["days-count"];
}

if (isset($_POST["generate-docx"])) {
    
    
    list($type_name, $type_price, $food_name, $food_price, $country_name, $country_price, $sum) = parse();
    
    $voucherData = [
        'order_number' => rand(1000, 9999),
        'name' => $_SESSION["name"],
        'phone' => $_SESSION["phone"],
        'email' => $_SESSION["email"],
        'tour_type' => $type_name,
        'tour_price' => $type_price,
        'country' => $country_name,
        'country_price' => $country_price,
        'food_type' => $food_name,
        'food_price' => $food_price,
        'days' => $_SESSION["days-count"],
        'services' => [],
        'total_price' => $sum
    ];
    
    if (isset($_SESSION["checkbox"])) {
        foreach ($_SESSION["checkbox"] as $service) {
            $parts = explode("#", $service);
            $voucherData['services'][] = [
                'name' => $parts[0],
                'price' => $parts[1]
            ];
        }
    }
    
    $phpWord = new PhpWord();
    $section = $phpWord->addSection();
    
    $section->addText(
        "Туристическая путевка № {$voucherData['order_number']}",
        ['bold' => true, 'size' => 16],
        ['alignment' => 'center']
    );
    $section->addTextBreak(1);
    
    $section->addText("Заказчик туристического продукта: {$voucherData['name']}");
    $section->addText("Телефон: {$voucherData['phone']}");
    $section->addText("Электронная почта: {$voucherData['email']}");
    $section->addTextBreak(1);
    
    $section->addText("Тип путевки: {$voucherData['tour_type']}");
    $section->addText("Страна пребывания: {$voucherData['country']}");
    $section->addText("Цена путевки базовая: {$voucherData['tour_price']}");
    $section->addText("Цена путевки с учетом страны: " . ($voucherData['tour_price'] + $voucherData['country_price']) . " руб.");
    $section->addTextBreak(1);

    $section->addText("Питание: {$voucherData['food_type']}, {$voucherData['food_price']}");
    $section->addTextBreak(1);
    
    
    
    $listStyle = ['listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED];
    $servicesTotal = 0; 
    $section->addText("Доп услуги:");
    foreach ($voucherData['services'] as $service) {
        $section->addListItem(
            "{$service['name']} ({$service['price']} руб.)", 
            0, 
            null, 
            $listStyle
        );
        $servicesTotal += $service['price']; 
    }
    
    $section->addTextBreak(1);
    $section->addText("Стоимость дополнительных услуг: {$servicesTotal} руб.");
    $section->addTextBreak(1);
    $section->addText("Количество дней: {$voucherData['days']}");
    
    $section->addTextBreak(1);
    $section->addText(
        "Полная стоимость тура: {$voucherData['total_price']} руб.",
        ['bold' => true],
        ['alignment' => 'left']
    );
    
    $section->addTextBreak(2);
    $section->addText(
        "Дата оформления: \n" . date('d.m.Y'),
        ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::START]
    );
    $section->addText(
        "Оператор: \n" . "Студент Ильин",
        ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END]
    );
    //$section->addText("Дата оформления: \n" . date('d.m.Y'));
    //$section->addText("Оператор: \n" . "Студент Ильин");
    
    header("Content-Description: File Transfer");
    header('Content-Disposition: attachment; filename="tour_voucher.docx"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');
    
    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save('php://output');

    exit;
}

function parse() {
    $type_name = explode("#", $_SESSION["type"])[0];
    $type_price = explode("#", $_SESSION["type"])[1];
    $days = isset($_SESSION["days-count"]) ? (int)$_SESSION["days-count"] : 1;
    $food_parts = explode("#", $_SESSION["food"]);                                                                
    $food_name = $food_parts[0];
    $food_price = $food_parts[1]; 
    $country_name = explode("#", $_SESSION["radioButtons"])[0];
    $country_price = explode("#", $_SESSION["radioButtons"])[1];

    $sum = 0;
    $sum += intval($type_price);
    $sum += intval($food_price * $days);
    $sum += intval($country_price);
    
    if (isset($_SESSION["checkbox"])) {
        foreach ($_SESSION["checkbox"] as $service) {
            $service_price = explode("#", $service)[1];
            $sum += intval($service_price);
        }
    }
    
    return array($type_name, $type_price, $food_name, $food_price, $country_name, $country_price, $sum);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Работа</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
</head>

<body topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0" background="../images/back_main.gif">
    <table cellpadding="0" cellspacing="0" border="0" align="center" width="583" height="614">
        <tr>
            <td valign="top" width="583" height="208" background="../images/row1.gif">
                <div style="margin-left:88px; margin-top:57px "><img src="../images/w1.gif"></div>
                <div style="margin-left:50px; margin-top:69px ">
                    <a href="../index.php">Главная<img src="../images/m1.gif" border="0"></a>
                    <img src="../images/spacer.gif" width="20" height="10">
                    <a href="order.php">Заказ<img src="../images/m2.gif" border="0"></a>
                    <img src="../images/spacer.gif" width="5" height="10">
                    <a href="basket.php">Корзина<img src="../images/m3.gif" border="0"></a>
                    <img src="../images/spacer.gif" width="5" height="10">
                    <a href="index-3.php">О компании<img src="../images/m4.gif" border="0"></a>
                    <img src="../images/spacer.gif" width="5" height="10">
                    <a href="index-4.php">Контакты<img src="../images/m5.gif" border="0"></a>
                </div>
            </td>
        </tr>
        <tr>
            <td valign="top" width="583" height="338" bgcolor="#FFFFFF">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td valign="top" height="338" width="42"></td>
                        <td valign="top" height="338" width="492">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td width="492" valign="top" height="106">
                                        <div style="margin-left:1px; margin-top:2px; margin-right:10px "><br>
                                            <div style="margin-left:5px "><img src="../images/1_p1.gif" align="left"></div>
                                            <div style="margin-left:95px "><font class="title">Название</font><br></div> 
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="492" valign="top" height="232">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td valign="top" height="232" width="248">
                                                    <div style="margin-left:6px; margin-top:2px; "><img src="../images/hl.gif"></div>
                                                    <div style="margin-left:6px; margin-top:7px; "><img src="../images/1_w2.gif"></div>

                                                    <?php
                                                    if (!isset($_COOKIE["auth_cookie"])) {
                                                        echo '<h1>Необходимо авторизоваться</h1>';
                                                    } elseif (!isset($_SESSION)) {
                                                        echo '<h1>Корзина пустая</h1>';
                                                    } else {
                                                        $img_path = [
                                                            "круиз" => "cruise.jpg",
                                                            "гастротур" => "gastro_tur.jpg",
                                                            "сафари" => "safari.jpeg"
                                                        ];
                                                        
                                                        list($type_name, $type_price, $food_name, $food_price, $country_name, $country_price, $sum) = parse();

                                                        echo '<h3>' . $_SESSION["name"] . ', вы оформили заказ</h3>';
                                                        echo '<h4>' . $type_name . ' по цене ' . $type_price . '</h4>';
                                                        echo '<h4>' . $food_name . ' к стоимости +' . $food_price . '</h4>';
                                                        echo '<h4>' . $country_name . ' к стоимости +' . $country_price . '</h4>';

                                                        echo '<h4>Доп услуги: </h4>';
                                                        
                                                        if (isset($_SESSION["checkbox"])) {
                                                            foreach ($_SESSION["checkbox"] as $service) {
                                                                $service_name = explode("#", $service)[0];
                                                                $service_price = explode("#", $service)[1];
                                                                echo '<h5>  ' . $service_name . ' к стоимости +' . $service_price . '</h5>';
                                                            }
                                                        } else {
                                                            echo '<h5>НЕТ</h5>';
                                                        }
                                                    
                                                        echo "<img width=200 height=200 src='./img/" . $img_path[$type_name] . "'>";
                                                    }
                                                    ?>    
                                                </td>
                                                <td valign="top" height="215" width="1" background="../images/tal.gif" style="background-repeat:repeat-y"></td>
                                                <td valign="top" height="215" width="243">
                                                    <div style="margin-left:22px; margin-top:2px; "><img src="../images/hl.gif"></div>
                                                    <div style="margin-left:22px; margin-top:7px; "><img src="../images/1_w2.gif"></div>
                                                    <div style="margin-left:22px; margin-top:13px; ">
                                                        <?php
                                                        if (isset($_COOKIE["auth_cookie"]) && isset($_SESSION)) {
                                                            echo "<h2>Итоговая сумма " . $sum . '</h2>';
                                                        }
                                                        ?>
                                                    </div>
                                                    <div style="margin-left:22px; margin-top:16px; "><img src="../images/hl.gif"></div>
                                                    <div style="margin-left:22px; margin-top:7px; "><img src="../images/1_w4.gif"></div>
                                                    <div style="margin-left:22px; margin-top:9px; ">
                                                        <form id="basket-form" method="post">
                                                            <?php if (isset($_COOKIE["auth_cookie"]) && isset($_SESSION)): ?>
                                                                <button type="submit" name="generate-docx">Скачать путевку (DOCX)</button>
                                                                <button type="submit" name="send-email">Отправить на почту</button>
                                                            <?php endif; ?>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td valign="top" height="338" width="49"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top" width="583" height="68" background="../images/row3.gif">
                <div style="margin-left:51px; margin-top:31px ">
                    <a href="#"><img src="../images/p1.gif" border="0"></a>
                    <img src="../images/spacer.gif" width="26" height="9">
                    <a href="#"><img src="../images/p2.gif" border="0"></a>
                    <img src="../images/spacer.gif" width="30" height="9">
                    <a href="#"><img src="../images/p3.gif" border="0"></a>
                    <img src="../images/spacer.gif" width="149" height="9">
                    <a href="index-5.php"><img src="../images/copyright.gif" border="0"></a>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>