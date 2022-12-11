<?php
error_reporting(-1);
require_once 'function.php';
//$race_result_data = get_race_data();
$race_result_sort_data = sort_object_by(get_race_data(),  "total_count");
?>


<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Урок 33</title>
</head>
<body>
<script src="./sort.js"></script>

<table class="table_sort">
    <thead>
        <th>НОМЕР УЧАСТНИКА</th>
        <th>ФАМИЛИЯ</th>
        <th>ГОРОД</th>
        <th>МАРКА АВТО</th>
        <th>заезд №1</th>
        <th>заезд №2</th>
        <th>заезд №3</th>
        <th>заезд №4</th>
        <th>ИТОГОВЫЕ ОЧКИ</th>
    </thead>
    <tbody>
    <?php foreach ($race_result_sort_data as $items): ?>
        <tr>
            <?php foreach ($items as $row): ?>
                <?php if($row == $items->attempts):?>
                    <?php foreach ($row as $r): ?>
                        <td><?php echo $r; ?></td>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if($row !== $items->attempts):?>
                    <td><?php echo $row; ?></td>
                <?php endif; ?>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>