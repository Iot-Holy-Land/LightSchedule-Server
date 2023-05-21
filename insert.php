<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

$host = "localhost";
$user = "root";
$pw = "1234";
$dbName = "iot";

// 요청된 파라미터 가져오기
$time = $_GET['time'];
$date = $_GET['date'];

// 데이터베이스 연결 설정
$conn = new mysqli($host, $user, $pw, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 삽입 쿼리 실행
$sql = "INSERT INTO lightschedule (time, date) VALUES ('$time', '$date')";
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
