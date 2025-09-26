<?php
include 'db.php';
 
if($_SERVER["REQUEST_METHOD"]=="POST" ){
    $title = $_POST['title'];

    //insert into tasks
    $task= $conn->prepare("INSERT INTO tasks (title) VALUES (?) ");
    $task->bind_param("s", $title);
    $task->execute();
    $task_id= $task->insert_id;

    //insert into history
    $history= $conn->prepare("INSERT INTO task_history (task_id, task_action, new_title) VALUES(?,'added',?)");
    $history->bind_param("is", $task_id, $title);
    $history->execute();

    header("location: index.php");
}
?>