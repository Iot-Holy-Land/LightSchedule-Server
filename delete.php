<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

$host = "localhost";
$user = "root";
$pw = "1234";
$dbName = "iot";

$mysqli = new mysqli($host, $user, $pw, $dbName);

// POST로 전달된 id 값 확인
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // 데이터베이스에서 해당 id의 값을 삭제하는 쿼리
  $query = "DELETE FROM lightschedule WHERE id = $id";

  // 쿼리 실행
  $result = $mysqli->query($query);

  // 쿼리 실행 결과 확인
  if ($result) {
    echo "Record deleted successfully.";
  } else {
    echo "Error deleting record: " . $mysqli->error;
  }
} else {
  echo "Invalid request.";
}

$mysqli->close();
?>
