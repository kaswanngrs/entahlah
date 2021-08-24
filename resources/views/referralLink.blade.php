<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/e48d166edc.js" crossorigin="anonymous"></script>
 
  <link rel="stylesheet" href="style.css">
  <title>Download Button With Timer</title>
 <style>

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: sans-serif;
}
body{
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}
.download-container{
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
.download-btn{
  position: relative;
  background: #4285F4;
  color: #fff;
  width: 260px;
  padding: 18px 0;
  text-align: center;
  font-size: 1.3em;
  font-weight: 400;
  text-decoration: none;
  border-radius: 50px;
  box-shadow: 0 5px 25px rgba(1 1 1 / 15%);
  transition:  background 0.3s ease;
 
}
.download-btn:hover{
  background: #1b57bd;
}
.download-btn i{
  margin-left: 5px;
}
.countdown{
  font-size: 1.1em;
  font-weight: 700;
  margin-bottom: 20px;
}
.countdown span{
  color: #0693F6;
  font-size: 1.5em;
  font-weight: 800;
}
 
.pleaseWait-text{
  font-size: 1.1em;
  font-weight: 600;
  display: none;
}
.manualDownload-text{
  font-size: 1.1em;
  font-weight: 600;
  display: none;
}
.manualDownload-link{
  color: #0693F6;
  font-weight: 600;
  text-decoration: none;
}

 </style>
</head>
<body  style="background-color:#d4cbcb4f">
  <div class="download-container">
  @if(!isset($Worning))
    <a href="#" class="download-btn"> <i class="fas fa-cloud-download-alt "></i> Download App</a>
  @else
  <h3 style="color:darkgoldenrod ; font-family: cursive;border-bottom:darkgoldenrod">  {{$Worning}} </h3>
  @endif
    <div class="countdown"></div>
    <div class="pleaseWait-text">Please Wait...</div>
    <div class="manualDownload-text">Direct Link <a href="" class="manualDownload-link">click here.</a></div>
  </div>
 
<script type="text/javascript">
  const downloadBtn = document.querySelector(".download-btn");
  const countdown = document.querySelector(".countdown");
  const pleaseWaitText = document.querySelector(".pleaseWait-text");
  const manualDownloadText = document.querySelector(".manualDownload-text");
  const manualDownloadLink = document.querySelector(".manualDownload-link");
  var timeLeft = 5;
 
  downloadBtn.addEventListener("click", () => {
    downloadBtn.style.display = "none";
    countdown.innerHTML = "Your download will start in <span>" + timeLeft + "</span> seconds."  //for quick start of countdown
 
    var downloadTimer = setInterval(function timeCount() {
      timeLeft -= 1;
      countdown.innerHTML = "Your download will start in <span>" + timeLeft + "</span> seconds.";
 
      if(timeLeft <= 0){
        clearInterval(downloadTimer);
        pleaseWaitText.style.display = "block";
        let download_href = "Testfile.rar"; //enter the downlodable file link here
        window.location.href = download_href;
        manualDownloadLink.href = download_href;
 
        setTimeout(() => {
          pleaseWaitText.style.display = "none";
        manualDownloadText.style.display = "block"
        }, 4000);
      }
    }, 1000);
  });
   
  </script>
 
</body>
</html>