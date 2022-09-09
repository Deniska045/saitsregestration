<?
require('connect.php');
$name = $_POST["name"];
$info = $_POST["info"];
$country  = $_POST["country"];
$price = $_POST["price"];
$result = $connect->query("INSERT INTO `info`(`name`, `info`, `country`, `price`)
                VALUES ('$name', '$info','$country',$price)");
if (!$result) {
    echo $connect->error;
    return;
}
header("Location: /index.php", TRUE, 301);
