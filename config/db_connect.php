<?php
// connect to database
$conn = mysqli_connect('localhost', 'bhagya', 'test1234', 'todolist');

// check connection 
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}
