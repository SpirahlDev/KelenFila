<?php 

$now = date_create("2023-05-13 09:00");

$date2 = date_create("2023-05-13 12:00");
echo $now->diff($date2)->invert;

?>