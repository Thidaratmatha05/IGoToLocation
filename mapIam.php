<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];;
}
if(isset($_POST["navigate"])){
    // รับค่าสถานทีสถานที่ 2 จากฟอร์ม
    $location1 = $_POST['location1'];
    $location2 = $_POST['location2'];
    
    // นำทางผู้ใช้ไปยังสถานที่ปลายทาง (ตัวอย่างเช่นการแสดงผลในที่นี้เป็นการสร้างลิงก์ URL)
    echo "<p>กำลังนำทางจาก $location1 ไปยัง $location2 ไปยัง</p>";
    echo "<a href='https://www.google.com/maps/dir/$location1/$location2'>ดูเส้นทางบน Google Maps</a>";
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Display Coordinates</title>
</head>
<body>

<h1>Coordinates</h1>
<button onclick="getLocation()">Get Coordinates</button>
<div id="coordinates"></div>

<p>Click the button to get your coordinates.</p>
<form action="" method="post">
    <label for="location1">Location 1:</label>
    <input type="text" id="location1" name="location1" value="<?php echo $latitude . "," . $longitude; ?>"><br><br>
 
    <label for="location2">Location 2:</label>
    <input type="text" id="location2" name="location2" required><br><br>

    <input type="submit" value="Navigate" name="navigate"> <!-- เปลี่ยนชื่อปุ่มเป็น 'navigate' -->
</form>


<script>
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showCoordinates);
    } else { 
        alert("Geolocation is not supported by this browser.");
    }
}

function showCoordinates(position) {
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;
    // document.getElementById('coordinates').innerHTML = "Latitude: " + latitude + "<br>Longitude: " + longitude;
    
    // ส่งค่าละติจูดและลองจิจูดไปยังเซิร์ฟเวอร์โดยใช้แบบฟอร์มแบบ POST
    const form = document.createElement('form');
    form.method = 'post';
    form.action = '';
    const inputLatitude = document.createElement('input');
    inputLatitude.type = 'hidden';
    inputLatitude.name = 'latitude';
    inputLatitude.value = latitude;
    const inputLongitude = document.createElement('input');
    inputLongitude.type = 'hidden';
    inputLongitude.name = 'longitude';
    inputLongitude.value = longitude;
    form.appendChild(inputLatitude);
    form.appendChild(inputLongitude);
    document.body.appendChild(form);
    form.submit();
}
</script>



</body>
</html>
