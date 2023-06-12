<?php

$host = "localhost";
$user = "root";
$pw = "1234";
$dbName = "iot";

// 데이터베이스 연결 설정
$conn = new mysqli($host, $user, $pw, $dbName);

// 데이터베이스 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 데이터베이스에서 데이터 가져오기
$query = "SELECT * FROM lightschedule";
$result = mysqli_query($conn, $query);

// 데이터 배열 초기화
$data = array();

// 결과를 배열로 변환
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// 데이터베이스 연결 닫기
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <title>Line Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="lineChart"></canvas>

    <script>
        // 데이터 배열 가져오기
        var data = <?php echo json_encode($data); ?>;

        // 시간을 담을 배열
        var labels = [];

        // 데이터 배열에서 시간을 분으로 변환하여 추출
        data.forEach(function(item) {
            // 예시: "10시20분"을 분으로 변환하여 추출
            // console.log(item.time);
            var timeArray = item.time;
            var hours = parseInt(timeArray.slice(0,3));
            var minutes = parseInt(timeArray.slice(3, 5));
            
            
            
            var totalMinutes = hours * 60 + minutes;
            
            // // 분 값을 배열에 추가
            labels.push(totalMinutes);
        });
        console.log(labels);


        // 그래프 그리기
        var ctx = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["5월12일","5월13일","5월14일"],
                datasets: [{
                    label: 'Time',
                    data: labels,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Index'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Time (Minutes)'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
