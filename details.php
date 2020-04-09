<?php
session_start();
include('config/db_connect.php');


if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM addtodo WHERE id = $id_to_delete";

    if (mysqli_query($conn, $sql)) {
        //success
        header("Location: signed.php");
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

<body class="white">
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
        }

        hr {
            width: 75%;
            height: 0.55px;
            background-color: grey;
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
    </style>
    <nav class="white z-depth-0">
        <div class="container">
            <a href="signed.php" id="title" class="brand-logo brand-text">ToDoList</a>
            <ul id="nav-mobile" class="right">
                <li><a href="addtodo.php" class="btn brand z-depth-0">Add a ToDo</a></li>
            </ul>
        </div>
    </nav>
    <hr>

    <div class="container grey-text ">
        <?php if ($todo) : ?>
            <h4>ToDo: <br><?php echo htmlspecialchars($todo['todo']); ?></h4>

            <p><?php echo date($todo['created_at']); ?></p>

            <!-- Delete FORM -->
            <form class="info" action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $todo['id'] ?>"> <input type="submit" name="delete" value="Delete" class=" btn brand z-depth-0">
            </form>

        <?php else : ?> <h5>No such ToDo exists!</h5>
        <?php endif; ?>
    </div>

</body>

</html>