<?php 
include("dbcon.php");

$data = "false";

if(isset($_GET["lat"])){
    $data .= $_GET["lat"];

$lat = $_GET["lat"];
$long = $_GET["long"];






$pqwerty = "SELECT * FROM `markers` W ORDER BY ABS(ABS(W.`lat`-".$lat.") + ABS(W.`lng`-".$long.")) ASC LIMIT 30 ";
if ($reqwerty = mysqli_query($conn, $pqwerty)){
if (mysqli_num_rows($reqwerty) > 0){ 
    
    while($rowqwerty = mysqli_fetch_array($reqwerty)){ 
        $name = $rowqwerty["name"]; 
        $address = $rowqwerty["address"]; 
        $lat = $rowqwerty["lat"];
        $lng = $rowqwerty["lng"]; 
        $id = $rowqwerty["id"]; 

      $data .= "<tr>
      <td>".$id."</td>
      <td>".$name."</td>
      <td>".$address."</td>
      <td>".$lat."</td>
      <td>".$lng."</td>
    </tr>";  

}}

} 



}
echo $data;

?>
