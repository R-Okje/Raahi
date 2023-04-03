<?php 
session_start(); 
$color="navbar-dark cyan darken-3";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="SHORTCUT ICON" href="images/fibble.png" type="image/x-icon" />
    <link rel="ICON" href="images/fibble.png" type="image/icon" />

    <title>Raahi - Scan Shipments</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">

  </head>
  <?php
    if( $_SESSION['role']==0 || $_SESSION['role']==1  ){
  ?>
  <body class="violetgradient">
    <?php include 'navbar.php'; ?>
    <center>
        <div class="customalert">
            <div class="alertcontent">
                <div id="alertText"> &nbsp </div>
                <img id="qrious">
                <div id="bottomText" style="margin-top: 10px; margin-bottom: 15px;"> &nbsp </div>
                <button id="closebutton" class="formbtn"> Done </button>
            </div>
        </div>
    </center>

    <div class="bgroles">
      <center>
        <div class="mycardstyle">
            <div class="greyarea">
                <h5> Please fill the following information  </h5>
                <form id="form2" autocomplete="off">
                    <div class="formitem">
                        <label type="text" class="formlabel"> Received Product ID </label>
                        <input type="text" class="forminput" id="prodid" onkeypress="isInputNumber(event)" required>
                        <label class=qrcode-text-btn style="width:4%;display:none;">
                            <input type=file accept="image/*" id="selectedFile" style="display:none" capture=environment onchange="openQRCamera(this);" tabindex=-1>
                        </label>
                        <center><button class="formbtn" onclick="openCamera()">Open Camera</button></center>
                        <video id="camera-stream" autoplay></video>
                        <video id="camera-stream" autoplay></video>
                        <center><button class="formbtn" onclick="closeCamera()">Stop Camera</button></center>

<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

<script>
let scanner;
let stream;

function openCamera() {
  const video = document.getElementById("camera-stream");

  Instascan.Camera.getCameras()
    .then((cameras) => {
      if (cameras.length > 0) {
        scanner = new Instascan.Scanner({ video });
        scanner.addListener("scan", (content) => {
          console.log(content); // do something with the QR code content
          closeCamera();
        });
        scanner.start(cameras[0]);
        stream = cameras[0].stream;
      } else {
        console.error("No cameras found.");
      }
    })
    .catch((error) => {
      console.error("Error accessing camera:", error);
    });
}

function closeCamera() {
  if (scanner) {
    scanner.stop();
    scanner = null;
  }
  if (stream) {
    stream.getTracks().forEach((track) => {
      track.stop();
    });
    const video = document.getElementById("camera-stream");
    video.srcObject = null;
  }
}
</script>
                          <!-- <script>
                          function openCamera() {
                            // Get the video element
                            const video = document.getElementById("camera-stream");

                            // Use the getUserMedia API to access the camera stream
                            navigator.mediaDevices.getUserMedia({ video: true })
                              .then((stream) => {
                                // Attach the stream to the video element
                                video.srcObject = stream;
                              })
                              .catch((error) => {
                                console.error("Error accessing camera:", error);
                              });
                          }
                          </script> -->
                          <video id="camera-stream" autoplay></video>
                          <!-- <center><button onclick="closeCamera()">Stop Camera</button></center> -->

<script>
let stream;

function openCamera() {
  const video = document.getElementById("camera-stream");

  navigator.mediaDevices.getUserMedia({ video: true })
    .then((mediaStream) => {
      stream = mediaStream;
      video.srcObject = stream;
    })
    .catch((error) => {
      console.error("Error accessing camera:", error);
    });
}
</script>
<button class="formbtn" onclick="document.getElementById('selectedFile').click();">  Scan QR
                        <button class="qrbutton2"  style="margin-bottom: 5px;margin-top: 5px;">
                       </button>
                    </div>
                    <div class="formitem">
                        <label type="text" class="formlabel"> Freight Hub Location </label>
                        <input type="text" class="forminput" id="prodlocation" required>
                    </div>
                    <button class="formbtn" id="mansub" type="submit">Update</button>
                </form>
            </div>
      </center>
    <?php
    }else{
        include 'redirection.php';
        redirect('index.php');
    }
    ?>

    <div class='box'>
      <div class='wave -one'></div>
      <div class='wave -two'></div>
      <div class='wave -three'></div>
    </div>
    
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Material Design Bootstrap-->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>

    <!-- Web3.js -->
    <script src="web3.min.js"></script>

    <!-- QR Code Library-->
    <script src="./dist/qrious.js"></script>

    <!-- QR Code Reader -->
	<script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>

    <script src="app.js"></script>

    <!-- Web3 Injection -->
    <script>
      // Initialize Web3
      if (typeof web3 !== 'undefined') {
        web3 = new Web3(web3.currentProvider);
        web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:7545'));
      } else {
        web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:7545'));
      }

      // Set the Contract
    var contract = new web3.eth.Contract(contractAbi, contractAddress);



    $("#manufacturer").on("click", function(){
        $("#districard").hide("fast","linear");
        $("#manufacturercard").show("fast","linear");
    });

    $("#distributor").on("click", function(){
        $("#manufacturercard").hide("fast","linear");
        $("#districard").show("fast","linear");
    });

    $("#closebutton").on("click", function(){
        $(".customalert").hide("fast","linear");
    });

    function sendWhatsappNotification(prodid, thisdate, prodlocation) {
  var apikey = "123456"; // replace API_KEY with your WhatsApp API key
  var phone = "+91"; // replace with the phone number you want to send the message to
  var message = "Item with id "+prodid+" has been scanned "+" on date "+thisdate+" at location "+prodlocation; // message to be sent
  var url = "https://api.callmebot.com/whatsapp.php?phone=" + phone + "&text=" + message + "&apikey=" + apikey;
  $.get(url, function(data) {
    console.log(data);
  });
}


    $('#form1').on('submit', function(event) {
        event.preventDefault(); // to prevent page reload when form is submitted
        prodname = $('#prodname').val();
        console.log(prodname);
        var today = new Date();
        var thisdate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();

        web3.eth.getAccounts().then(async function(accounts) {
          var receipt = await contract.methods.newItem(prodname, thisdate).send({ from: accounts[0], gas: 1000000 })
          .then(receipt => {
              var msg="<h5 style='color: #53D769'><b>Item Added Successfully</b></h5><p>Product ID: "+receipt.events.Added.returnValues[0]+"</p>";
              qr.value = receipt.events.Added.returnValues[0];
              $bottom="<p style='color: #FECB2E'> You may print the QR Code if required </p>"
              $("#alertText").html(msg);
              $("#qrious").show();
              $("#bottomText").html($bottom);
              $(".customalert").show("fast","linear");
              //sendWhatsappNotification(prodname, thisdate);
          });
          //console.log(receipt);
        });
        $("#prodname").val('');
        
    });

    // Code for detecting location
    // if (navigator.geolocation) {
    //     navigator.geolocation.getCurrentPosition(showPosition);
    // }
    // function showPosition(position) {
    //     var autoLocation = position.coords.latitude +", " + position.coords.longitude;
    //     $("#prodlocation").val(autoLocation);
    // }
    // position.coords.latitude
    // position.coords.longitude
    if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
    }

    function showPosition(position) {
    const latitude = position.coords.latitude;   // "19.24368242241368"
    const longitude = position.coords.longitude; //"72.8559719358147"
    const apiKey = "49eb65a2fab64eb9af20c7d346a79752";
    const apiEndpoint = `https://api.geoapify.com/v1/geocode/reverse?lat=${latitude}&lon=${longitude}&apiKey=${apiKey}`;

    fetch(apiEndpoint)
      .then(response => response.json())
      .then(data => {
        const locationName = data.features[0].properties.formatted;
        $("#prodlocation").val(locationName);
      })
      .catch(error => {
        console.error("Error fetching location data:", error);
      });
   } 
    $('#form2').on('submit', function(event) {
        event.preventDefault(); // to prevent page reload when form is submitted
        prodid = $('#prodid').val();
        prodlocation = $('#prodlocation').val();
        console.log(prodid);
        console.log(prodlocation);
        var today = new Date();
        var thisdate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()
               +' '+today.getHours()+':'+today.getMinutes()+':'+today.getSeconds();
        var info = "<br><br><b>Date and Time: "+thisdate+"</b><br>Location: "+prodlocation;

        // var today = new Date();
        // var thisdate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        // var info = "<br><br><b>Date: "+thisdate+"</b><br>Location: "+prodlocation;
        web3.eth.getAccounts().then(async function(accounts) {
          var receipt = await contract.methods.addState(prodid, info).send({ from: accounts[0], gas: 1000000 })
          .then(receipt => {
              var msg=" item has been updated ";
              $("#alertText").html(msg);
              $("#qrious").hide();
              $("#bottomText").hide();
              $(".customalert").show("fast","linear");
              sendWhatsappNotification(prodid, thisdate, prodlocation);
          });
        });
        $("#prodid").val('');
      });


    function isInputNumber(evt){
      var ch = String.fromCharCode(evt.which);
      if(!(/[0-9]/.test(ch))){
          evt.preventDefault();
      }
    }

//     function openCamera() {
//   navigator.mediaDevices.getUserMedia({ video: true, audio: false })
//     .then(function(stream) {
//       const video = document.getElementById("video-element");
//       video.srcObject = stream;
//       video.play();
//     })
//     .catch(function(err) {
//       console.log("An error occurred: " + err);
//     });
// }

// function closeCamera() {
//   if (stream) {
//     stream.getTracks().forEach((track) => {
//       track.stop();
//     });
//     const video = document.getElementById("camera-stream");
//     video.srcObject = null;
//   }
// }

    function openQRCamera(node) {
		var reader = new FileReader();
		reader.onload = function() {
			node.value = "";
			qrcode.callback = function(res) {
			if(res instanceof Error) {
				alert("No QR code found. Please make sure the QR code is within the camera's frame and try again.");
			} else {
				node.parentNode.previousElementSibling.value = res;
				document.getElementById('searchButton').click();
			}
			};
			qrcode.decode(reader.result);
		};
		reader.readAsDataURL(node.files[0]);
	}
//   function openQRCamera(node) {
//   // Get the canvas element by ID
//   const canvas = document.getElementById("canvas");
//   const ctx = canvas.getContext("2d");

//   // Use navigator.mediaDevices.getUserMedia to open the camera
//   navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
//     .then(function(stream) {
//       // Set the video element's srcObject to the camera stream
//       const video = document.createElement("video");
//       video.srcObject = stream;
//       video.setAttribute("playsinline", true); // Required for iOS
//       video.play();

//       // When the video is playing, capture a frame to the canvas
//       video.addEventListener("playing", function() {
//         canvas.width = video.videoWidth;
//         canvas.height = video.videoHeight;
//         setInterval(function() {
//           ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
//           const imageData = canvas.toDataURL("image/png");
//           qrcode.decode(imageData); // Decode the QR code from the canvas
//         }, 1000 / 30); // Capture a frame every 1/30 second
//       });
//     })
//     .catch(function(error) {
//       console.error("Unable to access the camera: " + error.message);
//     });

//   // Set the QR code callback function
//   qrcode.callback = function(res) {
//     if(res instanceof Error) {
//       alert("No QR code found. Please make sure the QR code is within the camera's frame and try again.");
//     } else {
//       node.parentNode.previousElementSibling.value = res;
//       document.getElementById('searchButton').click();
//     }
//   };
// }


  function showAlert(message){
      $("#alertText").html(message);
      $("#qrious").hide();
      $("#bottomText").hide();
      $(".customalert").show("fast","linear");
    }

    $("#aboutbtn").on("click", function(){
        showAlert("A Decentralised End to End Logistics Application that stores the whereabouts of product at every freight hub to the Blockchain. At consumer end, customers can easily scan product's QR CODE and get complete information about the provenance of that product hence empowering	consumers to only purchase authentic and quality products.");
    });

    </script>
  </body>
</html>
