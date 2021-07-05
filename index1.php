<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IP to Location</title>
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
    <script src="deviceAPI.js"></script>
    <style>
      .colbor {
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
    </style>
  </head>
  <body>
    <br /><br />
    <center>
      <button class="btn btn-primary" onclick="getMyIp()">Get My IP</button>
    </center>
    <br /><br />
    <div class="container">
      <div class="row">
        <div class="col colbor">
          <center>
            IPv4 :
            <input
              class="ip"
              id="ip"
              value=""
              style="width: 80%"
              placeholder="IPv4"
            />
            <br />
            <b id="locipv4"></b>
            <br />
            <b id="latipv4"></b>
            <br />
            <b id="lngipv4"></b>
          </center>
        </div>
        <div class="col colbor">
          <center>
            IPv6 :
            <input
              class="ip1"
              id="ip1"
              value=""
              style="width: 80%"
              placeholder="IPv6"
            /><br />
            <b id="locipv6"></b>
            <br />
            <b id="latipv6"></b>
            <br />
            <b id="lngipv6"></b>
          </center>
        </div>
      </div>

      <br /><br />
      <center>
        <button class="send btn btn-primary">Get Location</button>
        <button class="btn btn-success" onclick="fetchData()">
          Get Places
        </button>
      </center>

      <br /><br />

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
            <tbody id="datarecv"></tbody>
          </table>
        </div>
      </div>

      <br><br>
      <center>
      <b>Other Information</b>
      <table id="customers">
            <tr>
              <td>ISP</td>
              <td>TimeZone</td>
              <td>Zip Code</td>
              <td>Region</td>
              <td>Currency</td>
              <td>Country Population</td>
            </tr>
            <tr>
            <td id='isp'></td>
              <td id='tz'></td>
              <td id='zc'></td>
              <td id='reg'></td>
              <td id='cur'></td>
              <td id='pop'></td>
            </tr>
          </table>
      </center>

      <br><br>
      <center>
      <b>Other Information</b>
      <table id="customers">
            <tr>
              <td>Device name</td>
              <td>OS</td>
              <td>phone</td>
              <td>userAgents</td>
              <td>version('Webkit')</td>
              <td>versionStr('Build')</td>
            </tr>
            <tr>
            <td id='one'></td>
              <td id='two'></td>
              <td id='three'></td>
              <td id='four'></td>
              <td id='five'></td>
              <td id='siz'></td>
            </tr>
          </table>
      </center>
      <p id="md"></p>
    </div>
  </body>
  <script>
    $(".send").on("click", function () {
      $.getJSON(
        "https://ipapi.co/" + $(".ip").val() + "/json",
        function (data) {
          console.log("IPv4 :: ", data);
          $("#locipv4").text("Location : " + data.city);
          $("#latipv4").text("Latitude : " + data.latitude);
          $("#lngipv4").text("Longitude : " + data.longitude);
          // $(".country").text(data.country);
        }
      );

      $.getJSON(
        "https://ipapi.co/" + $(".ip1").val() + "/json",
        function (data) {
          console.log(data);
          $("#locipv6").text("Location : " + data.city);
          $("#latipv6").text("Latitude : " + data.latitude);
          $("#lngipv6").text("Longitude : " + data.longitude);

          $("#isp").text(data.org);
          $("#tz").text(data.timezone + " " + data.utc_offset);
          $("#zc").text(data.postal);
          $("#reg").text(data.region);
          $("#cur").text(data.currency_name + " | Symbol : " + data.currency);
          $("#pop").text(data.country_population);
          // $(".country1").text(data.country);
          var md = new MobileDetect(window.navigator.userAgent);

          $("#one").text(md.mobile());
          $("#two").text(md.os());
          $("#three").text(md.phone());
          $("#four").text(md.userAgents());
          $("#five").text(md.version('Webkit'));
          $("#six").text(md.versionStr('Build'));
          // $("#md").text(md);

          console.log( md.mobile() );          // 'Sony'
          console.log( md.phone() );           // 'Sony'
          console.log( md.userAgents() );          // null
          console.log( md.userAgent() );       // 'Safari'
          console.log( md.os() );              // 'AndroidOS'
          console.log( md.is('iPhone') );      // false
          console.log( md.is('bot') );         // false
          console.log( md.version('Webkit') );         // 534.3
          console.log( md.versionStr('Build') );       // '4.1.A.0.562'
          console.log( md.match('playstation|xbox') ); // false
          console.log("MD :: ", md)
        }
      );
    });

    function getIpV6() {
      $.get("https://www.cloudflare.com/cdn-cgi/trace", function (data) {
        // Convert key-value pairs to JSON
        // https://stackoverflow.com/a/39284735/452587
        data = data
          .trim()
          .split("\n")
          .reduce(function (obj, pair) {
            pair = pair.split("=");
            return (obj[pair[0]] = pair[1]), obj;
          }, {});
        console.log("IP V6", data);
        document.getElementById("ip1").value = data.ip;
      });
    }

    function getMyIp() {
      getIpV6();
      $.getJSON("https://api.db-ip.com/v2/free/self", function (data) {
        console.log(JSON.stringify(data, null, 2));
        $(".country").text(JSON.stringify(data, null, 2));
        document.getElementById("ip").value = data.ipAddress;
      });
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
          $("#datarecv").html(data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          console.log(XMLHttpRequest);
          console.log(textStatus);
          console.log(errorThrown);
          alert("some error");
        },
      });
    }

    function fetchData() {
      let lat = document.getElementById("latipv6").innerHTML;
      lat = lat.substr(11, lat.length);
      let long = document.getElementById("lngipv6").innerHTML;
      long = long.substr(11, long.length);

      let dataToSend = {
        lat,
        long,
      };

      $.ajax({
        url: "locationData.php",
        type: "GET",
        data: dataToSend,
        success: function (data) {
          console.log("Data :: ", data);
          $("#datarecv").html(data);
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
