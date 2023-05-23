<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>
<body>
  <div class="Modal">
    <img src="./assets/Alarm.png" />
    <button onclick="redirectToHomepage()">알람끄기</button>
  </div>

  <script>
    function redirectToHomepage() {
      window.location.href = "http://localhost:3000/";
    }

    window.addEventListener("DOMContentLoaded", function() {
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "http://10.150.149.88/BE/send?param1=true", true);
      xhr.send();
    });
  </script>
</body>
</html>
