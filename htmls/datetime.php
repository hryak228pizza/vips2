<?php

date_default_timezone_set('Europe/Moscow');


$moscowTime = new DateTime();
$day = $moscowTime->format('d');
$dayOfWeek = [
    'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье'
    ][$moscowTime->format('N') - 1];
$month = [
    'январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 
    'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь'
    ][$moscowTime->format('n') - 1];
$year = $moscowTime->format('Y');
$time = $moscowTime->format('H:i:s');


$cities = [
    [
        'name' => 'Мумбаи Индия',
        'timezone' => 'Asia/Kolkata',
        'day_name' => [
            'रविवार',  
            'सोमवार',  
            'मंगलवार', 
            'बुधवार',  
            'गुरुवार',  
            'शुक्रवार', 
            'शनिवार'   
        ],
        'month_name' => [
            'जनवरी','फरवरी','मार्च','अप्रैल','मई','जून','जुलाई','अगस्त','सितंबर','अक्टूबर','नवंबर','दिसंबर'],
        'utc_offset' => 'UTC +5:30',
        'msk_offset' => 'MSK +2:30',
    ],
    [
        'name' => 'Уанкайо Перу',
        'timezone' => 'America/Lima',
        'day_name' => [
            'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'
        ],
        'month_name' => [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ],
        'utc_offset' => 'UTC -5',
        'msk_offset' => 'MSK -8'
    ],
    [
        'name' => 'Ниамей Нигер',
        'timezone' => 'Africa/Niamey',
        'day_name' => [
            'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'
        ],
        'month_name' => [
            'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
            'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
        ],
        'utc_offset' => 'UTC +1',
        'msk_offset' => 'MSK -2'
    ],
    [
        'name' => 'Иркутск Россия',
        'timezone' => 'Asia/Irkutsk',
        'day_name' => [
            'воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'
        ],
        'month_name' => [
            'январь', 'февраль', 'март', 'апрель', 'май', 'июнь',
            'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь'
        ],
        'utc_offset' => 'UTC +8',
        'msk_offset' => 'MSK +5'
    ]
];


foreach ($cities as &$city) {
    $date = new DateTime('now', new DateTimeZone($city['timezone']));
    $dayNum = $date->format('d');
    $dayOfWeekNum = $date->format('N') - 1;
    $monthNum = $date->format('n') - 1;
    $yearNum = $date->format('Y');
    $timeStr = $date->format('H:i:s');
    
    $city['date_string'] = sprintf('%s %s %s %d год %s',
        $city['day_name'][$dayOfWeekNum],
        $dayNum,
        $city['month_name'][$monthNum],
        $yearNum,
        $timeStr
    );
}
unset($city); 
?>



<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мировое время</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
        }
        .hidden { display: none; }
    </style>
</head>
<body>
<button id="showTime">Показать время</button>
    <table id="timeTable"  class="hidden">
        <tr>
            <th colspan="4">Московское время <br> день: <?= $day ?>, <?= $dayOfWeek ?>, месяц: <?= $month ?>, год: <?= $year ?>, <?= $time ?></th>
        </tr>
        <tr>
            <?php foreach ($cities as $city): ?>
                <td><?= $city['name'] ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach ($cities as $city): ?>
                <td><?= $city['date_string'] ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach ($cities as $city): ?>
                <td><?= $city['utc_offset'] ?><br><?= $city['msk_offset'] ?></td>
            <?php endforeach; ?>
        </tr>
    </table>

    <script>
        document.getElementById('showTime').addEventListener('click', function () {
            const table = document.getElementById('timeTable');
            table.classList.remove('hidden'); 

        });
    </script>
</body>
</html>