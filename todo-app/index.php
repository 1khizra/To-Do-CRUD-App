<?php include 'db.php';  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP To-Do App</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:lightpurple;">
    <div class="container mt-5">
        <div class="row">

        <div class="col-md-6">
            <div class="card shadow-lg border-0 mb-4 ">
                <div class="card-header bg-primary text-white">
                    <h4>📝 To-Do List</h4>
                </div>
                <div class="card-body">
                   <form class="d-flex mb-3" method="POST" action="add_task.php">
                    <input type="text" class="form-control " name="title" placeholder="enter a new task" required>
                    <button type="submit" class="btn btn-success">Add</button>
                   </form> 

                   <ul class="list-group">
                    <?php
                    $result= $conn->query("SELECT * FROM tasks ORDER BY created_at DESC");
                    if($result->num_rows > 0){
                        while($row=$result->fetch_assoc()){
                            echo"
                            <li class='list-group-item d-flex justify-content-center align-items-center'>
                            <form class='d-flex' method='POST' action='update_task.php'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <input type='text' class='form-control me-2' name='title' value='{$row['title']}'>
                                <button type='submit' class='btn btn-sm btn-warning me-2'>Update</button>
                            </form>
                            <a href='delete_task.php?id={$row['id']}' class='btn btn-sm btn-danger'>Delete</a>
                            </li>";
                        }
                    }else{
                        echo "<li colspan='5' class='list-group-item text-center text-muted'>Not task yet.</li>";
                    }
                    ?>
                   </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-secondary text-white">
                    <h4> 📜History</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-dark">
                            <tr>
                                <th>Task ID</th>
                                <th>Action</th>
                                <th>Old Title</th>
                                <th>New Title</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $history= $conn->query("SELECT * FROM task_history ORDER BY action_time DESC");
                            if($history->num_rows > 0){
                                while($row= $history->fetch_assoc()){
                                    echo" <tr>
                                    <td>{$row['task_id']}</td>
                                    <td>{$row['task_action']}</td>
                                    <td>{$row['old_title']}</td>
                                    <td>{$row['new_title']}</td>
                                    <td>{$row['action_time']}</td>
                                    </tr>";
                                }
                            }else{
                                echo" <tr> 
                                <td colspan='5' class='text-center text-muted'> No history available</td>
                                </tr>";
                            }
                            ?>

                        </tbody>
                            

                        </table>

                    </div>
                </div>

            </div>

        </div>

        </div>

    </div>
    
</body>
</html>