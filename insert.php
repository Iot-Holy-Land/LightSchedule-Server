<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

$host = "localhost";
$user = "root";
$pw = "1234";
$dbName = "iot";

// 데이터베이스 연결 설정
$conn = new mysqli($host, $user, $pw, $dbName);

// 요청된 파라미터 가져오기
$time = $_GET['time'];
$date = $_GET['date'];
$ampm = $_GET['ampm'];

// 중복 레코드 확인
$sql = "SELECT COUNT(*) AS count FROM lightschedule WHERE time = '$time' AND date = '$date' AND ampm = '$ampm'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$count = $row['count'];

if ($count > 0) {
    echo 1;
} else {
    // 삽입 쿼리 실행
    $sql = "INSERT INTO lightschedule (time, date, ampm) VALUES ('$time', '$date', '$ampm')";
    if ($conn->query($sql) === TRUE) {
        echo "데이터 삽입성공";
    } else {
        echo "오류 : " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
