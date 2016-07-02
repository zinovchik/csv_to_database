<?php
$host = 'localhost'; // имя хоста (уточняется у провайдера)
$database = 'search_deleted_sites.com'; // имя базы данных, которую вы должны создать
$user = 'ipr.com'; // заданное вами имя пользователя, либо определенное провайдером
$pswd = 'ipr.com'; // заданный вами пароль
$dbh = '';

$dbh = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
mysql_select_db($database) or die("Не могу подключиться к базе.");

$row = 0;
if (($handle = fopen("sites.csv", "r")) !== FALSE) {
    $data = fgetcsv($handle, 1000, ";");
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $row++;
        $name = strtolower($data[1]);
        $query = "INSERT INTO `sites` (`name`) VALUES ('$name')";
        $res = mysql_query($query, $dbh);
        if ($res) {
            echo "1";
        } else {
            echo "0";
        }
    }
    fclose($handle);
    echo $row;
    print_r($data);
}
?>