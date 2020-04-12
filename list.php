<?php
session_start();
// My SQLi or PDO
include('config/db_connect.php');

// write query for all pizzas
$sql = 'SELECT todo, id FROM addtodo ORDER BY dated';

// make query & get results
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$todos = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

// close connection
mysqli_close($conn);
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
    
     .brand-text {
        color: black !important;
    }

     /*left panel*/
     #panel-left{
    float:left;
    z-index:-1;
    }
    
    /*title*/
    #maintitle{
    font-family: courier, monospace;
    color: white;
    font-size: 30px;
    margin-left: 40px;
    margin-top: 15px;
    font-size: 240%;
    }

/*typing amimatin*/
.lets {
    animation: typing 1.71s;
}
@keyframes typing
{
     0% {
        border-right: 2px solid white;
     }
     99.999% {
        border-right: 2px solid white;
     }
     100% {
        border-right: none;
     }
}

/*hr tag*/
    .title-line{
    background-image: linear-gradient(to right, rgba(255, 255, 255, 1), rgba(255, 255, 255, 0.75), rgba(255, 255, 255, 0));
    height: 2px;
    z-index: 5;
    border:none;
    margin-left: 35px;
    width:120%;
    margin-top: 0px !important;
    }
    
    /*logout styles*/
    #logout {
    position: fixed;
    top:-40px;
    background-color: #555;
    padding-top:5px;
    right: 350px;
    border-radius: 0 0 5px 5px;
    width:54px;
    height: 75px;
    text-align:center;
    transition: 0.4s;
    color: #EF9A9A;
}

/*dropdown*/
#bottom-closer {
    color:white;
    width: 15px;
}

/*hover logout animation*/
#logout:hover {
    top:0;
    color: white;
}

/*arrow anmation*/
.arrowdrop {
    animation: dropper 0.75s infinite;
}
@keyframes dropper
{
     0% {
        padding-top:1px;
     }50% {
        padding-top:7px;
     }
     100% {
        padding-top:1px;
     }
}

/*add to do button*/
.add-do{
    padding-left:10px;
    padding-top:4px;
    position: fixed;
    top:80px;
    background-color: #555;
    right: 350px;
    border-radius: 5px;
    width:84px;
    height: 27px;
    text-align:left;
    color:white;
    font-size: 11px;
    margin-right:0px !important;
    float: left;
}
/* hover effect */
.add-do:hover {
    animation: shadow-addpulse 0.60s infinite;
}
/* add button pulsing animation */
@keyframes shadow-addpulse
{
     0% {
          box-shadow: 0 0 0 0px rgba(0, 0, 0, 0.2);
     }
     100% {
          box-shadow: 0 0 0 10px rgba(0, 0, 0, 0);
     }
}

/*see the list of things*/
.seedo {
    position: absolute;
    font-family: courier, monospace;
    color: white;
    margin-left: 40px;
    margin-top: 45px;
    width: 69.5%;
}

/*header*/
h6 {
    color:black;
    font-size: 24px;
}

/*each box*/
.dobox {
    background: rgba(255, 255, 255, 0.9);
}

/* each to-do */
.dobject {
    padding-top: 5px;
    padding-left: 15px;
    padding-bottom: 5px;
    padding-right: 15px;
    background: rgba(239,154,154, 0.3);
    
}

/* each to-do info */
.dobjectinfo {
    padding-top: 5px;
    padding-left: 15px;
    padding-bottom: 5px;
    padding-right: 15px;
    background: rgba(255,255,255, 0.1) !important;
    font-size: 14px;
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
    right: 15px;
}

/* what general time of the day */
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
/* what general time of the day */
#user {
    position: absolute;
    top: -17px; left: 35px; bottom: 0; right: 15px;
    padding-top: 45px;
    font-family: courier, monospace;
    float: right;
    color: white;
    font-size: 36px;
    color:#EF9A9A;
    z-index: 5;
}

/*whats the time*/
#clock {
    position: absolute;
    top: -19px; left: 0; bottom: 0; right: 10px;
    padding-top: 70px;
    font-family: courier, monospace;
    text-align: right ;
    color: white;
    font-size: 60px;
    color:#EF9A9A;
}

/*day of the week*/
#dater {
    position: absolute;
    top: 55px; left: 0; bottom: 0; right: 15px;
    padding-top: 45px;
    font-family: courier, monospace;
    float: right;
    color: white;
    font-size: 52px;
    color:#EF9A9A;
}

/*date*/
#dated {
    position: absolute;
    top: 55px; left: 0; bottom: 0; right: 15px;
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
    top: 195px;
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
    top: 205px;
    width: 100%;
    height: 300px;
    color: #EF9A9A;
    text-align: left;
}

/*quote itself*/
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

/*quote author*/
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

/*quote button*/
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

/* overlay */
.options {
    position:absolute;
    width: 25px;
    height: 25px;
    left: 40px;
    top: 79px;
    color:white;
    }

.overlay {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.9);
        overflow-x: hidden;
        transition: 0.5s;
    }

    .overlay-content {
        position: relative;
        top: 25%;
        width: 100%;
        text-align: right;
        margin-top: 30px;
        padding-right: 50px;
    }

    .overlay a {
        padding: 8px;
        text-decoration: none;
        font-size: 36px;
        color: #818181;
        display: block;
        transition: 0.5s;
    }

    .overlay a:hover,
    .overlay a:focus {
        color: white;
        transition: 0.6s;
    }

    .overlay .closebtn {
        position: absolute;
        top: 20px;
        right: 45px;
        font-size: 60px;
    }

    @media screen and (max-height: 450px) {
        .overlay a {
            font-size: 20px
        }

        .overlay .closebtn {
            font-size: 40px;
            top: 15px;
            right: 35px;
        }
    }
    
    .finger{
        transition: 0.4s;
         color: #EF9A9A;
    }
    
    .finger:hover{
        color: white;
    }
</style>

<!-- entire body -->
<body class="red lighten-3">

<!-- menu option -->
<div id="myNav" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="overlay-content">
            <a href="#">Math.</a>
            <a href="#">Biology.</a>
            <a href="#">Chemistry.</a>
            <a href="#">Physics.</a>
            <a href="#">Add your own category.</a>

        </div>
    </div>

    <div class="options left">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776</span>

    </div>

   <!--left panel-->
   <div id="panel-left">
       <!--title of the page-->
        <div id="maintitle"></div>
        <!--title underline-->
        <hr class="title-line">
        <a href="index.php" id="logout"><i class="finger small material-icons">fingerprint</i>
        <br>
        <!--logout dropdown-->
        <span id="bottom-closer">
            <!--bouncing arrows-->
        <i class="small material-icons arrowdrop">arrow_drop_down</i>
        </span>
        </a>
        <!--add a to-do-->
        <a href="addtodo.php" class="add-do">
            ADD TO-DO
        </a>
        <!--see do's -->
        <div class="seedo">
           <div class="row">
            <?php foreach ($todos as $todo) : ?>
                    <div class="card z-depth-0 dobox">
                        <div class="dobject left-align">

                            <h6>
                                <?php echo htmlspecialchars($todo['todo']); ?>
                            </h6>

                        </div>
                        <div class="dobjectinfo left-align dobox">
                            <a href="details.php?id=<?php echo $todo['id'] ?>" class="brand-text">more info</a>
                        </div>
                    </div>
                
            <?php endforeach; ?>
        </div>
        </div>
    </div> 
   

<!-- side panel -->
<div id="panel-side">
<!-- time container -->
<div>
<!-- saying -->
<div id='saying' class="right-align"></div>
<div id="user" class="right-align"> <?php echo $_SESSION['user']?>!</div>
     <br>
<!-- time -->
     <div id='clock' class="right-align"></div>
     <br>
     <!-- day of the week -->
     <div id='dater' class="right-align"></div>
     <br>
     <!--date-->
     <div id='dated' class="right-align"></div>
     </div>

<!--hr line-->
     <hr class="liner">
     
     <!-- entire quote container -->
     <div id="quote-container">
         <!--quote container-->
        <div id="quote-l">
            <!--quote-->
            <blockquote id="quote-line">"Change your life today. Don't gamble on the future, act now, without delay."</blockquote>
        </div>
                 <!--author container-->
        <div id="quote-a">
            <!--author-->
            <p id="quote-author">Simone de Beauvoir</p>
        </div>
        <!--gen quote button-->
        <a onClick="genQuote();" class="waves-light btn btn-small quote-b">Generate a new Quote</a>
    </div>
    <!--weather-->
    <div class="weather">
    <a class="weatherwidget-io" href="https://forecast7.com/en/53d54n113d49/edmonton/" data-label_1="EDMONTON" data-icons="Climacons Animated" data-days="3" data-theme="pure" data-shadow="rgba(151, 140, 140, 0.05)" data-accent="rgba(241, 28, 28, 0.02)" data-textcolor="#EF9A9A" data-highcolor="#EF9A9A" data-lowcolor="#EF9A9A" data-snowcolor="#000000" ></a>
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
    saying = "Good Morning" 
} else if (hours >= 12 && hours < 15) {
    saying = "Good Afternoon"
} else if(hours >= 15 && hours < 18){
    saying = "Good Evening"
}else {
    saying = "Good Night"
}
console.log(saying);
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
var speed = 60;

function typeWriter() {
  if (i < txt.length) {
    document.getElementById("maintitle").innerHTML += txt.charAt(i);
    i++;
    setTimeout(typeWriter, speed);
    document.getElementById("maintitle").classList.add("lets");
  }
}
 // This runs the displayTime function the first time
 typeWriter();
});
</script>

<!-- animated menu -->
<script>
        function openNav() {
            document.getElementById("myNav").style.width = "100%";
        }

        function closeNav() {
            document.getElementById("myNav").style.width = "0%";
        }
    </script>

    </body>
    
</html>