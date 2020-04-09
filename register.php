<?php
session_start();
include('config/db_connect.php');

$fname = $lname = $email = $pass = $repass = '';
$errors = array('fname' => '', 'lname' => '', 'email' => '', 'pass' => '', 'repass' => '', 'typed' => '');
$formError = false;

if (isset($_POST['submit'])) {

    // check first name fname
    if (empty($_POST['fname'])) {
        $errors['fname'] = 'A first name is required <br>';
    } else {
        $fname = $_POST['fname'];
        // (start with, allow all lower case and upper case along with spaces as many times as the user chooses, close)
        if (!preg_match('/^[a-zA-Z\s]+$/', $fname)) {
            $errors['fname'] = 'A valid first name must be letters and spaces only';
        }
    }

    // check last name lname
    if (empty($_POST['lname'])) {
        $errors['lname'] = 'A last name is required <br>';
    } else {
        $lname = $_POST['lname'];
        // (start with, allow all lower case and upper case along with spaces as many times as the user chooses, close)
        if (!preg_match('/^[a-zA-Z\s]+$/', $lname)) {
            $errors['lname'] = 'A valid last name must be letters and spaces only';
        }
    }

    // check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required <br>';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be a valid email address';
        }
    }

    // check password and repassword

    if (empty($_POST['pass'])) {
        $errors['pass'] = 'A password is required <br>';
    }
    if (empty($_POST['repass'])) {
        $errors['repass'] = 'Retype the password <br>';
    }

    if ($_POST['pass'] !== $_POST['repass']) {
        $pass = $_POST['pass'];
        $repass = $_POST['repass'];
        $errors['typed'] = 'Password does not match';
    }

    if (array_filter($errors)) {
        // echo 'errors in the form';
        $formError = true;
    } else {
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, $_POST['pass']);
        $repass = mysqli_real_escape_string($conn, $_POST['repass']);

        // create sql
        $sql = "INSERT INTO users(fname, lname, inemail, inpass, repassword) VALUES('$fname', '$lname', '$email', '$pass', '$repass')";


        // save to db and check
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: index.php');
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
          box-shadow: 0 0 0 17px rgba(161,222,147, 0);
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
        width: 85%;
         background: #5A81AC;
    }

    .create:hover {
        width: 100%;
        transition-timing-function: ease-out;
        transition: 0.5s;
        background: #49688a;
    }

    .modal {
        max-height: 65%;
        overflow: hidden;
        border-radius:5px;
    }

    input[type="submit"] {
        width: 95%;
        margin-top: 0px;
        margin-bottom: 0px;
    }

    input[type="submit"]:hover {
        width: 100%;
        transition-timing-function: ease-out;
        transition: 0.6s;
        background: #49688a;
    }

    .modal-close {
        position: absolute;
        top: 10px;
        right: 20px;
        padding: 0;
        margin: 0;
        transition-duration: 3s;
    }

    
   /* label underline focus color for email */
   .input-field input[type=email]:focus, .input-field input[type=password]:focus, .input-field input[type=text]:focus {
     border-bottom:1px solid #49688a !important;

   }

   /* icon prefix focus color */
   .input-field .prefix.active {
     color: #49688a;
   }
.xout:: hover {
    background:red;
}
 
</style>

<!-- entire body -->
<body class="red lighten-3">
    <!-- main title shown on entrance -->
    <div class="container center">
        <a href="#createAcc" class="options option-a waves-effect waves-purple btn btn-large modal-trigger">Create an account</a>
        <a href="index.php" class="options option-b waves-effect waves-purple btn btn-large modal-trigger">Cancel</a>
    </div>

    <!-- modal -->
    <div id="createAcc" class="modal modal-fixed-footer">
        <h5 class="modal-close waves-effect waves-red xout">&#10005;</h5>
        <div class="modal-content center">
            <h4>Create an Account</h4>
            <br>
            <!-- this is the code run -->
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <!-- for first name -->
                <div class="input-field">
                    <i class="material-icons prefix">person</i>
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="white">
        <label for="fname">First name:</label>
        <input type="text" name="fname" value="<?php echo htmlspecialchars($fname) ?>">
        <div class="red-text left-align move_right"><?php echo $errors['fname']; ?></div>

                </div>
                <br>
                <!-- for last name -->
                <div class="input-field">
                    <i class="material-icons prefix">person</i>
        <label for="lname">Last name:</label>
        <input type="text" name="lname" value="<?php echo htmlspecialchars($lname) ?>">
        <div class="red-text left-align move_right"><?php echo $errors['lname']; ?></div>

                </div>
                <br>
                
                <!-- for email -->
                <div class="input-field">
                    <i class="material-icons prefix">email</i>
               <label>Your Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text left-align move_right"><?php echo $errors['email']; ?></div>

                </div>
                <br>

                <!-- for user password -->
                <div class="input-field">
                    <i class="material-icons prefix">lock</i>
                            <label>Password:</label>
        <input type="password" name="pass" value="<?php echo htmlspecialchars($pass) ?>">
        <div class="red-text left-align move_right"><?php echo $errors['pass']; ?></div>
                </div>
                <br>
                
                <!-- for user confirm password -->
                <div class="input-field">
                    <i class="material-icons prefix">lock</i>
                                    <label>Retype Password:</label>
        <input type="password" name="repass" value="<?php echo htmlspecialchars($repass) ?>">
        <div class="red-text left-align move_right"><?php echo $errors['repass']; ?></div>
        <div class="red-text left-align move_right"><?php echo $errors['typed']; ?></div>
                </div>
                <br>

                <br>
                <!-- confirm create an account -->
                <div class="regis">
                <input type="submit" name="submit" value="Sign Up" class="btn btn-small create waves-effect waves-red">
            </div>
        </div>
        </form>
    </div>

    <script>
        // open the modal on click
        $(document).ready(function() {
            $('#createAcc').modal();
            // keep page open
            <?php if ($formError) : ?>
                $('#createAcc').modal('open');
            <?php endif ?>
        });

        // on "register" page hover show event
        $(document).ready(function() {
            $('.tooltipped').tooltip();
        });
    </script>

</body>

</html>

