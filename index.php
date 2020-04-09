<?php
include('config/db_connect.php');

$email = $pass = '';
$errors = array('email' => '', 'pass' => '', 'check' => '');
$formError = false;

if (isset($_POST['submit'])) {

    // check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required <br>';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be a valid email address';
        }
    }

    // check pass
    if (empty($_POST['pass'])) {
        $errors['pass'] = 'A password is required <br>';
    }

    if (array_filter($errors)) {
        // echo 'errors in the form';
        // $formError = true;
    } else {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, $_POST['pass']);
}
        // create sql
        $sql = "SELECT * FROM users WHERE inemail = '$email' AND inpass = '$pass'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0 ) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    //  success
            header('Location: signed.php');
    }
} else {
   // error
            $errors['check'] = 'The email/password is incorrect.';
            $formError = true;
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

<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Baloo+Thambi+2&display=swap');
    body {
        background: #EF9A9A;
    }

    .move_right {
        margin-left: 45px;
    }

    .material-tooltip {
        padding-top: 10px;
    }

    a.btn {
        margin-top: 30%;
    }
    
.creat {
        background: #5A81AC;
    }
    
    /* make on account */
    .create {
        margin-top: 20px !important;
        width: 87%;
        background: #5A81AC;
    }

/* make on account on hover styles */
    .create:hover {
        width: 100%;
        transition-timing-function: ease-out;
        transition: 0.58s;
        background: #49688a;
    }
    /* first entrance page option */
   .options{
        background: #5A81AC;
    }

    /* first entrance page option on hover style */
    .option-a:hover{
        background: #A1DE93;
         transition: 0.4s;
         color:black;
         animation: shadow-pulse 0.85s infinite;
    }

@keyframes shadow-pulse
{
     0% {
          box-shadow: 0 0 0 0px rgba(0, 0, 0, 0.2);
     }
     100% {
          box-shadow: 0 0 0 20px rgba(161,222,147, 0);
     }
}

/* open modal */
    .modal {
        max-height: 75%;
        overflow: hidden;
        
    }

/* login button */
    input[type="submit"] {
        width: 87%;
        margin-top: 30px;
        margin-bottom: 0px;
      background: #5A81AC;
    }
/* hover login button */
    input[type="submit"]:hover {
        width: 100%;
        transition-timing-function: ease-out;
        transition: 0.58s;
        background: #49688a;
    }

/* close the modal */
    .modal-close {
        position: absolute;
        top: 10px;
        right: 15px;
        padding: 0;
        margin: 0;
        transition-duration: 3s;
    }

   /* label underline focus color for email */
   .input-field input[type=email]:focus {
     border-bottom:1px solid #49688a !important;

   }
      /* label underline focus color for pass */
      .input-field input[type=password]:focus {
     border-bottom:1px solid #49688a !important;

   }

   /* icon prefix focus color */
   .input-field .prefix.active {
     color: #49688a;
   }

/* before remember me */
   .checkbox[type="checkbox"] + label:before{
    background: transparent;
}
/* after remember me */
.checkbox[type="checkbox"]:checked + label:before{
    border: 2px solid transparent;
    border-bottom: 2px solid #49688a;
    border-right: 2px solid #49688a;
    background: transparent;
}
</style>

<!-- entire body -->
<body class="red lighten-3">
    <!-- main title shown on entrance -->
    <div class="container center">
        <a href="#login" class="waves-effect waves-light btn btn-large options option-a modal-trigger">Login</a>
    </div>

    <!-- modal -->
    <div id="login" class="modal">
        <h5 class="modal-close waves-effect waves-red">&#10005;</h5>
        <div class="modal-content center">
            <h4 class="formatted">Login Form</h4>
            <br>
            <!-- this is the code run -->
            <form action="index.php" method="POST">
                <!-- for user email -->
                <div class="input-field">
                    <i class="material-icons prefix">person</i>
                    <label>Your Email:</label>
                    <input id="name" type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
                    <div class="red-text left-align move_right"><?php echo $errors['email']; ?></div>
                </div>
                <br>

                <!-- for user password -->
                <div class="input-field">
                    <i class="material-icons prefix">lock</i>
                    <label for="pass">Password:</label>
                    <input id="pass" type="password" name="pass" value="<?php echo htmlspecialchars($pass) ?>">
                    <div class="red-text left-align move_right"><?php echo $errors['pass']; ?></div>
                    <div class="red-text left-align move_right"><?php echo $errors['check']; ?></div>
                </div>
                <br>

                <div class="left" style="margin-left:20px;">
                    <input type="checkbox" id="check" class="checkbox">
                    <label for="check">Remember Me</label>
                </div>
                <br>
                <!-- login and create an account -->
                <input type="submit" name="submit" value="Login" class="btn btn-small creat">
                <a href="register.php" class="btn btn-small create waves-effect waves-light">Create an Account</a>
        </div>
        </form>
    </div>

    <script>
        // open the modal on click
        $(document).ready(function() {
            $('#login').modal();
            // keep page open
            <?php if ($formError) : ?>
                $('#login').modal('open');
            <?php endif ?>

        });

        // on "login" hover shown event
        $(document).ready(function() {
            $('.tooltipped').tooltip();
        });
    </script>
</body>

</html>