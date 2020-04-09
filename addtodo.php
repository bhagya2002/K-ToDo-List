<?php
session_start();
// connect to the database
include('config/db_connect.php');

// PHP variables
$todo = '';
$errors = array('todo' => '');

// when form is submitted this runs
if (isset($_POST['submit'])) {

    // check todo
    if (empty($_POST['todo'])) {
        // is the field is left blank
        $errors['todo'] = 'A reminder is required <br>';
    } else {
        // is filled then store the user input to the variable
        $title = $_POST['todo'];
        // (start with, allow all lower case and upper case along with spaces as many times as the user chooses, close)
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            // if there is an error in the REGEX code for wht is allowed this error shows
            $errors['todo'] = 'Reminder must be only letters and spaces only';
        }
    }

    // // check date
    // if (empty($_POST['date'])) {
    //     $errors['date'] = 'A date is required <br>';
    // }

    // check for objects in the errors array
    if (array_filter($errors)) {
        // echo 'errors in the form';
    } else {
        $todo = mysqli_real_escape_string($conn, $_POST['todo']);
        // $date = mysqli_real_escape_string($conn, $_POST['date']);

        // create sql
        $sql = "INSERT INTO addtodo(todo) VALUES('$todo')";


        // save to db and check
        if (mysqli_query($conn, $sql)) {
            //success and redirect
            header('Location: signed.php');
        } else {
            // error and display error message
            echo 'query error:' . mysqli_error($conn);
        }
    }
} // end of post check


?>

<!DOCTYPE html>
<html lang="en">

<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<style type="text/css">
    .brand {
        background: #cbb09c !important;
    }

    .brand-text {
        color: #cbb09c !important;
    }

    form {
        max-width: 620px;
        margin: 20px auto;
        padding: 20px;
    }

    hr {
        width: 75%;
        height: 0.55px;
        background-color: grey;
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
</style>

<!-- body  -->
<body>

<!-- header of the page -->
    <nav class="white z-depth-0">
    <!-- header -->
        <div class="container"><a href="signed.php" class="brand-logo brand-text">ToDoList</a>
        </div>
    </nav>
    <hr>

<!-- container for the to-do input -->
    <section class="filllist left container grey-text">
    <!-- for to fill for inputs -->
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="white">

        <!-- what is the reminder -->
            <label>What do you need done?</label>
            <!-- input the reminder -->
            <input type="text" name="todo" value="<?php echo htmlspecialchars($todo) ?>">
            <!-- error in the reminder -->
            <div class="red-text"><?php echo $errors['todo']; ?></div>
            <!-- <label>Date</label>
        <input type="date" name="date" value="<?php echo htmlspecialchars($date) ?>">
        <div class="red-text"><?php echo $errors['date']; ?></div> -->

            <div class="left">
            <!-- submit the form -->
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
                <div>
                <!-- cancel add to-do -->
                    <a href="signed.php" class=" cancel btn brand z-depth-0">Cancel</a>
                </div>
            </div>
            
        </form>
    </section>

</body>

</html>