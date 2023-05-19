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

// GET 요청일 경우에만 처리
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $time = $_GET['time']; 
    $date = $_GET['date']; 

    // 둘 다 빈 문자열인 경우 데이터 삽입하지 않음
    if (!empty($time) && !empty($date)) {
        // 중복 데이터 제거를 위한 쿼리 작성
        $query = "DELETE FROM lightschedule WHERE time = '$time' AND date = '$date'";

        // 중복 데이터 제거 실행
        if ($mysqli->query($query)) {
            echo "중복 데이터 제거 완료";
        } else {
            echo "중복 데이터 제거 실패: " . $mysqli->error;
        }

        // 데이터베이스에 삽입할 쿼리 작성
        $query = "INSERT INTO lightschedule (time, date) VALUES ('$time', '$date')"; 

        // 쿼리 실행
        if ($mysqli->query($query)) {
            echo "데이터 삽입 성공";
        } else {
            echo "데이터 삽입 실패: " . $mysqli->error;
        }
    } else {
        echo "데이터를 입력하지 않았습니다.";
    }
} 

// 데이터 조회 쿼리
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
