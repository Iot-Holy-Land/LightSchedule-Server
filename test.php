<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

$host = "localhost";
$user = "root";
$pw = "1234";
$dbName = "iot";

// MySQL 연결
$mysqli = new mysqli($host, $user, $pw, $dbName);

// 연결 확인
if ($mysqli->connect_errno) {
    die("MySQL 연결 실패: " . $mysqli->connect_error);
}

// 쿼리 실행
$query = "SELECT * FROM lightschedule";
$result = $mysqli->query($query);

// 결과 확인
if ($result) {
    // 결과를 배열로 저장
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // JSON 형식으로 반환
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo "쿼리 실행 실패: " . $mysqli->error;
}

// 연결 닫기
$mysqli->close();
?>
