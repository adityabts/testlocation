<?php
include("dbcon.php");
?>
<html>
  <head>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
	<script src="jquery.min.js"></script>
    <title>Location test</title>
    <style>
      .colbor {
        border: 1px solid black;
      }

      .colbor1 {
        border: 1px solid black;
        padding: 1rem;
      }

      #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      #customers td,
      #customers th {
        border: 1px solid #ddd;
        padding: 8px;
      }

      #customers tr:nth-child(even) {
        background-color: #f2f2f2;
      }

      #customers tr:hover {
        background-color: #ddd;
      }

      #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04aa6d;
        color: white;
      }
	  .smalltext{
		  font-size:10px
	  }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row" style="margin-top: 1rem">
        <div class="col-2 colbor">
          <center>
            <h1>Location</h1>
            <br /><br /><br />
            <p id="demo"></p>
            <br /><br /><br />
            <button
              type="button"
              class="btn btn-primary"
              onclick="getLocation()"
            >
              Get Location
            </button>
          </center>
        </div>
        <div class="col-5 colbor">
          <center><h1>Data in DB</h1></center>

          <table id="customers" class="smalltext">
            <tr>
              <td>ID</td>
              <td>Name</td>
              <td>Area</td>
              <td>Latitude</td>
              <td>Longitude</td>
            </tr>
            <?php 
                $pqwerty1 = "SELECT * FROM `markers` ORDER BY ID ASC";
                if ($reqwerty1 = mysqli_query($conn, $pqwerty1)){
                if (mysqli_num_rows($reqwerty1) >  0){
					 while($rowqwerty1 = mysqli_fetch_array($reqwerty1)){ 
						$name1 = $rowqwerty1["name"]; 
						$address1 = $rowqwerty1["address"]; 
						$lat1 = $rowqwerty1["lat"]; 
						$lng1 = $rowqwerty1["lng"]; 
						$id1 = $rowqwerty1["id"]; 
							echo "<tr>
						<td>".$id1."</td>
						<td>".$name1."</td>
						<td>".$address1."</td>
						<td>".$lat1."</td>
						<td>".$lng1."</td>
						</tr> "; 
					}}} 
			?>
          </table>
        </div>
        <div class="col-5 colbor">
          <center><h1>Location on Map</h1></center>
          <img src="location.png" width="100%" style="width:100%"/>
        </div>
      </div>

      <div class="row" style="margin-top: 1rem">
        <div class="col colbor1">
          <center>
            <button type="button" class="btn btn-primary" onclick="getData('auto')">
              Get Stores by My location
            </button>
          </center>
        </div>
        <div class="col colbor1">
          <center>
            <input
              type="text"
              class="form-control"
              placeholder="Latitude"
              name="lat"
              id="latman"
            /><br />
            <input
              type="text"
              class="form-control"
              placeholder="Longitude"
              name="long"
              id="longman"
            /><br /><br />
            <button type="button" class="btn btn-success" onclick="getData('man')">
              Get Location Manually
            </button>
          </center>
        </div>
      </div>

      <div class="row">
        <div class="col colbor1">
          <table id="customers">
            <tr>
              <td>ID</td>
              <td>Name</td>
              <td>Area</td>
              <td>Latitude</td>
              <td>Longitude</td>
            </tr>
			<tbody id="datarecv">

			</tbody>
          </table>
        </div>
      </div>
    </div>

    <input type="hidden" id="lat" />
    <input type="hidden" id="long" />
  </body>
  <script>
    var x = document.getElementById("demo");

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }

    function showPosition(position) {
      x.innerHTML =
        "Latitude: " +
        position.coords.latitude +
        "<br>Longitude: " +
        position.coords.longitude;

      document.getElementById("lat").value = position.coords.latitude;
      document.getElementById("long").value = position.coords.longitude;
    }

    function getData(action) {
      let dataToSend = {};
      if (action === "auto") {
        let a = document.getElementById("lat").value;
        let b = document.getElementById("long").value;

        dataToSend = {
          lat: a,
          long: b,
        };
      } else {
        let c = document.getElementById("latman").value;
        let d = document.getElementById("longman").value;
        dataToSend = {
          lat: c,
          long: d,
        };
      }

	  console.log("Data To Send :: 🚀", dataToSend);
      $.ajax({
        url: "locationData.php",
        type: "GET",
        data: dataToSend,
        success: function (data) {
          console.log("Data :: ", data);
		  $('#datarecv').html(data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          console.log(XMLHttpRequest);
          console.log(textStatus);
          console.log(errorThrown);
          alert("some error");
        },
      });
    }
  </script>
</html>
