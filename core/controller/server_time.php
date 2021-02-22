<?php
include '../init.php';
$date = new DateTime(date('Y-m-d H:i:s'));
$time2 = $date->format('F d, Y H:i:s');

echo json_encode($time2);

        ?>
