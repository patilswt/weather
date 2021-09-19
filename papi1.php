<?php
date_default_timezone_set("Asia/Kolkata");

$cityname = $_POST['cname'];

$apiKey = "aa6a27980fc75bef322db2bae83f71f0";
$wApiUrl = "http://api.openweathermap.org/data/2.5/weather?q=" . $cityname . "&units=metric&appid=" . $apiKey;


$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $wApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$cod = $data->cod;
if($cod != "200"){
echo "<h3 style='text-align: center''>City not found</h3>";
}else{
$lon = $data->coord->lon;
$lat = $data->coord->lat;

$currentTime = time();
?>
<div class="row">
<div class="current" style="background-color:#000033;color: white;"><h2><?php echo date("l g:i a", $currentTime)."<br>".date("jS F, Y", $currentTime); ?><h2></div>

<div class="current" >
  <i class='fas fa-cloud-sun' style='font-size:120px;color:#ffff80'></i><br><br>
  <p style='color:#001a66'>
  <?php echo "<i class='fas fa-temperature-high'></i> <b>".$data->main->temp_max."</b>&degC <i class='fas fa-temperature-low'></i> ".$data->main->temp_min."&degC<br>".ucwords($data->weather[0]->description)."<br>Humidity ".$data->main->humidity."% <br><i class='fas fa-wind'></i> ".$data->wind->speed; ?></div>
</p>
<div class="current" style="background-color:#ffff80;color: #001a66;"><h1><?php echo $data->name; ?></h1></div>
</div>

<?php
$wfApiUrl = "https://api.openweathermap.org/data/2.5/onecall?lat=".$lat."&lon=".$lon."&units=metric&exclude=current,minutely,hourly,alerts&appid=" . $apiKey;

$ch1 = curl_init();

curl_setopt($ch1, CURLOPT_HEADER, 0);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch1, CURLOPT_URL, $wfApiUrl);
curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch1, CURLOPT_VERBOSE, 0);
curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
$response1 = curl_exec($ch1);

curl_close($ch1);
$data1 = json_decode($response1);
?><div class="footer"><div class="row"><?php 
foreach ($data1->daily as $abc) {
  $dt = $abc->dt;
?>  
  <div class="column" style="background-color:#b3b3ff;border-color:white;border-width:5px;border-style:double;">
  <?php 

    echo "<b>".date("l", $dt )."</b><br>".date("d M", $dt )."<br><br><i class='fas fa-cloud-sun-rain' style='font-size:35px;color: white'></i><br><br><b>".$abc->temp->max."</b>&degC / ".$abc->temp->min."&degC";

  ?>
  </div>
  
<?php  } ?>
</div>
  </div>
<?php  } ?>


