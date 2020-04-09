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
body {
        background: #EF9A9A;
    }

    .move_right {
        margin-left: 45px;
    }
    
    .cons {
        margin-top: 5px;
    }
    
    .cons:hover{
        transition: 0.5s;
        background: #b19cd9;
    }
    
    .options{
        background: #5A81AC;
    }
     .option-b{
        margin-left: 15px;
    }
    
    .option-a:hover{
        background: #A1DE93;
         transition: 0.5s;
         color:black;
         animation: shadow-pulse 0.70s infinite;
    }
    
     .option-b:hover{
        background: #F7F48B;
         transition: 0.5s;
         color:black;
         animation: shadow-pulse 0.70s infinite;
    }

@keyframes shadow-pulse
{
     0% {
          box-shadow: 0 0 0 0px rgba(0, 0, 0, 0.2);
     }
     100% {
          box-shadow: 0 0 0 15px rgba(161,222,147, 0.4);
     }
}

    .material-tooltip {
        padding-top: 10px;
    }

    a.btn {
        margin-top: 30%;
    }

    .create {
        margin-top: 5px !important;
        width: 75%;
         background: #5A81AC;
    }

    .create:hover {
        width: 100%;
        transition-timing-function: ease-out;
        transition: 0.5s;
        background: #5A81AC;
    }
</style>

<body class="red lighten-3">
    <!-- main title shown on entrance -->
    <div class="container center">
        <a href="list.php" class="options option-a waves-effect waves-purple btn btn-large modal-trigger" >View</a>
        <a href="index.php" class="options option-b waves-effect waves-purple btn btn-large modal-trigger">Logout</a>
    </div>

    <script>
        // on "register" page hover show event
        $(document).ready(function() {
            $('.tooltipped').tooltip();
        });
    </script>
    </body>
    
</html>