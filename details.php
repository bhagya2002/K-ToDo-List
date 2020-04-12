<?php
session_start();
include('config/db_connect.php');


if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM addtodo WHERE id = $id_to_delete";

    if (mysqli_query($conn, $sql)) {
        //success
        header("Location: list.php");
    } {
        //failure
        echo 'query error: ' . mysqli_error(($conn));
    }
}

// check GET request id param
if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // make sql
    $sql = "SELECT * FROM addtodo WHERE id= $id";

    // get query results
    $result = mysqli_query($conn, $sql);

    // fetch result in array format
    $todo = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);
}
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
        .brand {
            background: #cbb09c !important;
        }

        .brand-text {
            color: #cbb09c !important;
        }

        form {
            max-width: 620px;
        }

        .info {
            padding-left: -40px;
        }

        @media (max-width: 400px) {
            #title {
                left: 20px;
                transform: none !important;

            }
        }

        body {
        background: #EF9A9A;
    }

/*title*/
#maintitle{
    font-family: courier, monospace;
    color: white;
    font-size: 30px;
    margin-left: 0%;
    margin-top: 15px;
    font-size: 240%;
     background: #EF9A9A;
    }

    .lets {
    animation: typing 0.95s;
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
    position:absolute;
    background-image: linear-gradient(to right, rgba(255, 255, 255, 1), rgba(255, 255, 255, 0.75), rgba(255, 255, 255, 0));
    height: 2px;
     border:none;
     left: 13%;
     top: 55px;
     width:60%;
    }

    .doheader {
        margin-top: 25px;
        font-size:34px;
        font-family: courier, monospace;
        text-decoration: underline;
    }
    .do {
        margin-top:-20px;
        margin-left: 25px;
        font-size: 25px;
        font-family: courier, monospace;
    }
    

    .colored {
      background: rgb(255,255,255);
      color: rgb(239,154,154);
      border: 0.5px solid rgba(218, 224, 219, 0.6);
      transition: 0.3s;
    }
    
    .colored:hover {
        color: rgb(255,255,255);
    background: rgb(239,154,154);
    border: none;
    }
    .boxer {
border-radius:5px;
color:rgb(239,154,154) !important;
padding-left: 10px;
padding-bottom: 10px;
    }
    .creater  {
        color: #555;
    }
    </style>

<!-- entire body -->
<body class="red lighten-3">

<div class="container "><a href="list.php" id="maintitle" ></a>
        </div>
    <hr class="title-line">

    <div class="container white-text white boxer">
        <?php if ($todo) : ?>
            <div class="doheader">To-Do: </div>
            <br>
           <div class="do"> 
           <?php echo htmlspecialchars($todo['todo']); ?>
            </div>

<!-- needs to be done by -->
<div>
            <p> <span class="creater">  Needs to be done by: </span><?php echo date($todo['dated']); ?></p>
            </div>

<!-- created at the time stamp of -->
            <div>
            <p> <span class="creater">  Created at: </span><?php echo date($todo['created_at']); ?></p>
            </div>
            
            <!-- Delete FORM -->
            <form class="info" action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $todo['id'] ?>"> <input type="submit" name="delete" value="Delete" class="colored btn z-depth-0">
            </form>

        <?php else : ?> <h5>No such ToDo exists!</h5>
        <?php endif; ?>
    </div>


<!-- typewriter -->
<script>
 $(document).ready( function() {
var i = 0;
var txt = 'More Info!';
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
</body>

</html>