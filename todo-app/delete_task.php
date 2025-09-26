<?php
include 'db.php';

if(isset($_GET['id'])){
    $id=$_GET['id'];

//get old title 
$old=$conn->prepare("SELECT title FROM tasks WHERE id=?");
$old->bind_param("i",$id);
$old->execute();
$old_result = $old->get_result()->fetch_assoc();
$old_title=$old_result['title'];

  // Insert into history first
    $history = $conn->prepare("INSERT INTO task_history (task_id, task_action, old_title) VALUES (?, 'deleted', ?)");
    $history->bind_param("is", $id, $old_title);
    $history->execute();

//delete from tasks
$del=$conn->prepare("DELETE FROM tasks WHERE id=?");
$del->bind_param("i",$id);
$del->execute();

header("Location: index.php");
}
?>