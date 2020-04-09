<?php
// My SQLi or PDO
include('config/db_connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- materialze icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- materialize js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
</head>

<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Staatliches');
@import url('https://fonts.googleapis.com/css?family=Caveat|Merienda');
* {
    box-sizing: border-box;
}
body {
        background: #EF9A9A;
    }

     /*left panel*/
     #panel-left{
 float:left;
    height: 5000px;
    z-index:-1;
    }
    #maintitle{
    font-family: courier, monospace;
    color: white;
    font-size: 30px;
    margin-left: 50px;
    margin-top: 18px;
    font-size: 37px;
    }
    .title-line{
        background-image: linear-gradient(to right, rgba(255, 255, 255, 1), rgba(255, 255, 255, 0.75), rgba(255, 255, 255, 0));
        height: 2px;
        z-index: 5;
     border:none;
     margin-left: 42px;
     width:150%;
     margin-top: 0px !important;
    }

     /*right panel*/
    #panel-side{
    position: fixed;
    height: 100%;
    width:310px;
    float:right;
background: white;
z-index:-1;
top: 0;
  bottom: 0;
 right: 25px;
}
/* clock and date */
#saying {
    position: absolute;
    top: -45px; left: 0; bottom: 0; right: 15px;
    padding-top: 45px;
    font-family: courier, monospace;
    float: right;
    color: white;
    font-size: 31px;
    color:#EF9A9A;
}
#clock {
    position: absolute;
    top: -49px; left: 0; bottom: 0; right: 10px;
    padding-top: 70px;
    font-family: courier, monospace;
    text-align: right ;
    color: white;
    font-size: 60px;
    color:#EF9A9A;
}
#dater {
    position: absolute;
    top: 25px; left: 0; bottom: 0; right: 15px;
    padding-top: 45px;
    font-family: courier, monospace;
    float: right;
    color: white;
    font-size: 52px;
    color:#EF9A9A;
}
#dated {
    position: absolute;
    top: 25px; left: 0; bottom: 0; right: 15px;
    padding-top: 105px;
    font-family: courier, monospace;
    float: right;
    color: white;
    font-size: 28px;
    color:#EF9A9A;
}

/* hr break */
.liner{
    position: absolute;
    top: 165px;
    z-index:10;
    width: 100%;
    height:2px;
    padding: 0;
    border: none;
    border-top: medium double #EF9A9A;
    text-align: center;
}

.liner:after {
    content: "₭";
    display: inline-block;
    position: relative;
    top: -0.8em;
    left:10px;
    font-size: 1.2em;
    padding: 0 0.10em;
    color: #EF9A9A;
    background:white;
    border-radius: 25px;
    text-align: center;
}

/* Quote stuff */
#quote-container {
    position: absolute;
top: 175px;
    width: 100%;
    height: 300px;
    color: #EF9A9A;
    text-align: left;
}

#quote-line {
    position: absolute;
    height: 60%;
    width: 96%;
    margin-top:18px;
    border-left: 0px !important;
    text-align: left;
    font-weight: bold;
    font-family: 'Merienda', cursive;
    font-size: 16px;
}

#quote-author {
    position: absolute;
    height: 60%;
    width: 100%;
    margin-top:113px;
    left: 38px;
    text-align: left;
    font-family: 'Caveat', cursive;
    font-size: 16px;
    background: rgba(255, 0, 255, 0);
}
.quote-b {
    position: absolute;
  margin-top:46%; 
  left:23px; 
  background: white;
  color: #EF9A9A;
}
.quote-b:hover {
    background: white;
    animation: shadow-pulse 0.70s infinite;
}

/* pulsing animation */
@keyframes shadow-pulse
{
     0% {
          box-shadow: 0 0 0 0px rgba(0, 0, 0, 0.2);
     }
     100% {
          box-shadow: 0 0 0 10px rgba(0, 0, 0, 0);
     }
}

/* weather widget */
.weather {
    content-align:center;
    width:95%;
    margin-left:10px;
    height: 150px;
    margin-top:315px;
    font-family: 'Caveat', cursive;
}
</style>

<!-- entire body -->
<body class="red lighten-3">

   <!--left panel-->
   <div id="panel-left">
        <div id="maintitle"></div>
        <hr class="title-line">
    </div> 

<!-- side panel -->
<div id="panel-side">
<!-- time container -->
<div>
<!-- saying -->
<div id='saying' class="right-align"></div>
     <br>
<!-- time -->
     <div id='clock' class="right-align"></div>
     <br>
     <!-- date -->
     <div id='dater' class="right-align"></div>
     <br>
     <div id='dated' class="right-align"></div>
     </div>

     <hr class="liner">
     
     <div id="quote-container">
        <div id="quote-l">
            <blockquote id="quote-line"></blockquote>
        </div>
        <div id="quote-a">
            <p id="quote-author"></p>
        </div>
        <a onClick="genQuote();" class="waves-light btn btn-small quote-b">Generate a Quote</a>
    </div>
    <div class="weather">
    <a class="weatherwidget-io" href="https://forecast7.com/en/53d54n113d49/edmonton/" data-label_1="EDMONTON" data-icons="Climacons Animated" data-days="3" data-theme="pure" data-shadow="rgba(151, 140, 140, 0.05)" data-accent="rgba(241, 28, 28, 0.02)" data-textcolor="#EF9A9A" data-highcolor="#EF9A9A" data-lowcolor="#EF9A9A" data-snowcolor="#000000" ></a>

    <!-- <a class="weatherwidget-io" href="https://forecast7.com/en/40d71n74d01/new-york/" data-icons="Climacons Animated" data-label_1="NEW YORK" data-label_2="WEATHER" data-days="5" data-theme="pure" data-textcolor="#EF9A9A" >NEW YORK WEATHER</a> -->
    <!-- <a class="weatherwidget-io" data-icons="Climacons Animated" href="https://forecast7.com/en/20d5978d96/india/" data-label_1="INDIA" data-label_2="WEATHER" data-days="5" data-theme="pure" data-textcolor="#EF9A9A" data-snowcolor="#000000" >INDIA WEATHER</a> -->

    </div>
 
     </div>

<!-- javascript for clock and date -->
    <script>
       $(document).ready( function() {
// display the clok
  function displayTime() {
    //   get values for the clock
    var currentTime = new Date();
    var saying = '';
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();
    var seconds = currentTime.getSeconds();
    var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    var day = days[currentTime.getDay()];
    var date = currentTime.getDate();
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var month = months[currentTime.getMonth()];
    var year = currentTime.getFullYear();

    // second numbers
    if (seconds < 10) {
    // Add the "0" digit to the front
    // so 9 becomes "09"
    seconds = "0" + seconds;
}
// hour numbers
if (hours < 10) {
    // Add the "0" digit to the front
    // so 9 becomes "09"
    hours = "0" + hours;
}
// minute numbers
if (minutes < 10) {
    // Add the "0" digit to the front
    // so 9 becomes "09"
    minutes = "0" + minutes;
}

if (hours >= 5 && hours < 12) {
    saying = "Good Morning!"
} else if (hours >= 12 && hours < 15) {
    saying = "Good Afternoon!"
} else if(hours >= 15 && hours < 18){
    saying = "Good Evening!"
}else {
    saying = "Good Night!"
}
    // This gets a "handle" to the clock div in our HTML
    var clockDiv = document.getElementById('clock');
    var dateDiv = document.getElementById('dated');
    var daterDiv = document.getElementById('dater');
    var sayingDiv = document.getElementById('saying');

    // Then we set the text inside the clock div 
    // to the hours, minutes, and seconds of the current time
    clockDiv.innerText = hours + ":" + minutes + ":" + seconds;
    daterDiv.innerText = day;
    sayingDiv.innerText = saying;
    dateDiv.innerText = month + " " + date + ", " + year;
  }
  // This runs the displayTime function the first time
  displayTime();
setInterval(displayTime, 1000);
});
    </script>

    <!-- javascript for quotes -->
<script>
let quotes, quote, quoteauthor;
let randNum;

// Load JSON file into quotes
fetch("quotes.txt")
	.then((rawData) => rawData.text())
	.then((data) => quotes = JSON.parse(data));

function genQuote() {
	lastIndex = randNum;
	randNum = Math.floor(Math.random() * quotes.length + 1); // Generate a Random Quote from the list
	quote = quotes[randNum].inspire; // Gets the line of Quote
	quoteauthor = quotes[randNum].author; // Gets the author of Quote
	document.getElementById("quote-line").innerHTML = '"' + quote + '"';
	document.getElementById("quote-author").innerHTML = "- " + quoteauthor;
}
</script>
<!-- weather -->
<script>
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
</script>

<!-- typewriter -->
<script>
 $(document).ready( function() {
var i = 0;
var txt = 'Welcome To Your To-Do List!';
var speed = 35;

function typeWriter() {
  if (i < txt.length) {
    document.getElementById("maintitle").innerHTML += txt.charAt(i);
    i++;
    setTimeout(typeWriter, speed);
  }
}
 // This runs the displayTime function the first time
 typeWriter();
setInterval(typeWriter, 1000);
});
typeWriter();
</script>

    </body>
    
</html>