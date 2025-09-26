<?php
include 'db.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $id=$_POST['id'];
    $new_title=$_POST['title'];

    //get old title
    $old=$conn->prepare("SELECT title FROM tasks WHERE id=?");
    $old->bind_param("i", $id);
    $old->execute();
    $old_result=$old->get_result()->fetch_assoc();
    $old_title=$old_result['title'];

    //update tasks
    $update = $conn->prepare("UPDATE tasks SET title=? WHERE id=?");
    $update->bind_param("si",$new_title, $id);
    $update->execute();

    //history
    $history= $conn->prepare("INSERT INTO task_history(task_id,task_action,old_title,new_title) VALUES(?,'updated',?,?)");
    $history->bind_param("iss",$id,$old_title,$new_title);
    $history->execute();

    header("location:  index.php");


}

?>