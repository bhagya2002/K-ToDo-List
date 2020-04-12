<?php
session_start();
include('config/db_connect.php');

$todo = '';
$dater = '';
$errors = array('todo' => '', 'dated' => '');
$namer = $_SESSION['user'];

if (isset($_POST['submit'])) {

    // check title
    if (empty($_POST['todo'])) {
        $errors['todo'] = 'A reminder is required <br>';
    } else {
        $title = $_POST['todo'];
    }

    // check date
    if (empty($_POST['dated'])) {
        $errors['dated'] = 'A date is required <br>';
    }else {
        $dater = $_POST['dated'];
    }

    if (array_filter($errors)) {
        // echo 'errors in the form';
    } else {
        $todo = mysqli_real_escape_string($conn, $_POST['todo']);
        $dater = mysqli_real_escape_string($conn, $_POST['dated']);
        // $date = mysqli_real_escape_string($conn, $_POST['date']);

        // create sql
        $sql = "INSERT INTO addtodo(todo, dated, user) VALUES('$todo', '$dater', '$namer')";


        // save to db and check
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: list.php');
        } else {
            // error
            echo 'query error:' . mysqli_error($conn);
        }
    }
} // end of post check
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
    animation: typing 0.9s;
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
    
    .backdrop {
        background: #EF9A9A;
    }

    form {
        max-width: 620px;
        margin: 5px auto;
        margin-top:35px;
        padding: 20px;
        height: 300px;
        width: 85%;
    border-radius:5px;
    }

section {
position:absolute;
    top: 70px;
    left: 15px;
    
}

    .options {
        width: 25px;
        height: 25px;
        margin: 20px -210px 0px 15.5%;
    }

    .filllist {
        padding-left: 55px;
    }

    .cancel {
        margin-top: 20px;
    }
    .colored {
      background: rgb(255,255,255);
      color: rgb(239,154,154);
      border: 0.5px solid rgba(218, 224, 219, 0.6);
      transition: 0.45s;
    }
    
    .colored:hover {
    color: rgb(255,255,255);
    background: rgb(239,154,154);
    border: none;
    }

    .labelled{
        color: #EF9A9A;
        font-size: 15px;
    }
    .input-field input[type=text]:focus {
     border-bottom:4px solid #EF9A9A;

   }
     /* icon prefix focus color */
   .input-field {
     color: #555;
     border-bottom:1px solid #EF9A9A !important;
   }
</style>

<!-- entire body -->
<body class="red lighten-3">


        <div class="container "><a href="list.php" id="maintitle" ></a>
        </div>
    <hr class="title-line">

    <section class="filllist left container grey-text">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="white">
            <label class="labelled">What do you need done?</label>
            <input class="input-field" type="text" name="todo" value="<?php echo htmlspecialchars($todo) ?>">
            <div class="red-text"><?php echo $errors['todo']; ?></div>
            <label for="dated" class="labelled">Enter a date for when this is due:</label>
  <input class="input-field" type="date" id="dated" name="dated" placeholder="yyyy-mm-dd" min="2020-03-31" value="<?php echo htmlspecialchars($dater) ?>"><br>
        <div class="red-text"><?php echo $errors['dated']; ?></div>
            <div class="left">
                <input type="submit" name="submit" value="submit" class="colored btn brand z-depth-0">
                <div>
                    <a href="list.php" class="colored cancel btn brand z-depth-0">Cancel</a>
                </div>
            </div>
        </form>
    </section>

<!-- typewriter -->
<script>
 $(document).ready( function() {
var i = 0;
var txt = 'Add my To-Do!';
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