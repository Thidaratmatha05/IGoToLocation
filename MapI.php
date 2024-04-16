<!DOCTYPE html>
<html>
<body>
<h1>HTML Geolocation</h1>

<p>Click the button to get your coordinates.</p>

<button onclick="getLocation()">Try It</button>

<p id="demo"></p>

<form action="" method="post">
    <label for="location1">Location 1 (Latitude, Longitude):</label>
        <input type="text" id="location1" name="location1" placeholder="Latitude, Longitude" required><br><br>
    <label for="location2">Location 2:</label>
        <input type="text" id="location2" name="location2" required><br><br>

        <input type="submit" value="Navigate" name="navigate"> <!-- เปลี่ยนชื่อปุ่มเป็น 'navigate' -->
</form>


<?php
if(isset($_POST["navigate"])){
    // รับค่าสถานที่ 1 และสถานที่ 2 จากฟอร์ม
    $location1 = $_POST['location1'];
    $location2 = $_POST['location2'];

    // แยกค่า Latitude และ Longitude ออกจากกันโดยใช้ explode()
    $coordinates = explode(", ", $location1);
    $latitude = $coordinates[0];
    $longitude = $coordinates[1];

    // นำทางผู้ใช้ไปยังสถานที่ปลายทาง (ตัวอย่างเช่นการแสดงผลในที่นี้เป็นการสร้างลิงก์ URL)
    echo "<p>กำลังนำทางจาก $location1 ไปยัง $location2 ไปยัง</p>";
    echo "<a href='https://www.google.com/maps/dir/$latitude,$longitude/$location2'>ดูเส้นทางบน Google Maps</a>";
}
?>
<?php
// รับค่า Latitude และ Longitude จากแอปพลิเคชันผ่านการส่งข้อมูลเป็น POST request
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// ตั้งค่า API key ของ Google Maps Geocoding API
$apiKey = 'AIzaSyBbGf_oYjI5qoewIZi4dp5JXvij6Ml4kVg';

// สร้าง URL สำหรับเรียกใช้งาน Google Maps Geocoding API
$apiUrl = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$latitude,$longitude&key=$apiKey";

// ทำการเรียกใช้งาน API
$response = file_get_contents($apiUrl);

// แปลงข้อมูลที่ได้รับมาจาก API จาก JSON เป็น array
$data = json_decode($response, true);

// ตรวจสอบว่ามีข้อมูลที่อยู่
if(isset($data['results'][0]['formatted_address'])) {
    $address = $data['results'][0]['formatted_address'];
    echo "ที่อยู่: $address";
} else {
    echo "ไม่พบข้อมูลที่อยู่";
}
?>


<script>
const x = document.getElementById("demo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
}
</script>


</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];;
}
?>
<?php
if(isset($_POST["navigate"])){
    // รับค่าสถานทีสถานที่ 2 จากฟอร์ม
    $location1 = $_POST['location1'];
    $location2 = $_POST['location2'];
    
    // นำทางผู้ใช้ไปยังสถานที่ปลายทาง (ตัวอย่างเช่นการแสดงผลในที่นี้เป็นการสร้างลิงก์ URL)
    echo "<p>กำลังนำทางจาก $location1 ไปยัง $location2 ไปยัง</p>";
    echo "<a href='https://www.google.com/maps/dir/$location1/$location2'>ดูเส้นทางบน Google Maps</a>";
}
?>

