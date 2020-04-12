<?php
session_start();
// My SQLi or PDO
include('config/db_connect.php');

// write query for all to-do's
$sql = "SELECT * FROM addtodo WHERE categor = 'Math' ORDER BY dated";

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
        background-color: rgba(255, 255, 255, 0.85);
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
        color: #EF9A9A;
        display: block;
        transition: 0.5s;
    }

    .overlay a:hover,
    .overlay a:focus {
        color: #555;
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

</style>

<!-- entire body -->
<body class="red lighten-3">

<!-- menu option -->
<div id="myNav" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="overlay-content">
            <a href="#">Math.</a>
            <a href="category/bio.php">Biology.</a>
            <a href="category/chem.php">Chemistry.</a>
            <a href="category/phys.php">Physics.</a>
            <a href="category/other.php">Other.</a>

        </div>
    </div>

    <div class="options left">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776</span>

    </div>

   <!--left panel-->
   <div id="panel-left">
       <!--title of the page-->
       <a href="list.php">
       <div id="maintitle"></div>
        </a> 
        <!--title underline-->
        <hr class="title-line">

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
<!-- typewriter -->
<script>
 $(document).ready( function() {
var i = 0;
var txt = 'To-Do under the math category!';
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