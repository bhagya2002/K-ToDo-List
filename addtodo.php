<?php
session_start();
include('config/db_connect.php');

$todo = '';
$errors = array('todo' => '');

if (isset($_POST['submit'])) {

    // check title
    if (empty($_POST['todo'])) {
        $errors['todo'] = 'A reminder is required <br>';
    } else {
        $title = $_POST['todo'];
        // (start with, allow all lower case and upper case along with spaces as many times as the user chooses, close)
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['todo'] = 'Reminder must be only letters and spaces only';
        }
    }

    // // check date
    // if (empty($_POST['date'])) {
    //     $errors['date'] = 'A date is required <br>';
    // }

    if (array_filter($errors)) {
        // echo 'errors in the form';
    } else {
        $todo = mysqli_real_escape_string($conn, $_POST['todo']);
        // $date = mysqli_real_escape_string($conn, $_POST['date']);

        // create sql
        $sql = "INSERT INTO addtodo(todo) VALUES('$todo')";


        // save to db and check
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: signed.php');
        } else {
            // error
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

<body>
    <nav class="white z-depth-0">
        <div class="container"><a href="signed.php" class="brand-logo brand-text">ToDoList</a>
        </div>
    </nav>
    <hr>

    <section class="filllist left container grey-text">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="white">
            <label>What do you need done?</label>
            <input type="text" name="todo" value="<?php echo htmlspecialchars($todo) ?>">
            <div class="red-text"><?php echo $errors['todo']; ?></div>
            <!-- <label>Date</label>
        <input type="date" name="date" value="<?php echo htmlspecialchars($date) ?>">
        <div class="red-text"><?php echo $errors['date']; ?></div> -->
            <div class="left">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
                <div>
                    <a href="signed.php" class=" cancel btn brand z-depth-0">Cancel</a>
                </div>
            </div>
        </form>
    </section>

</body>

</html>