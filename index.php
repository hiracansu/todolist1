<?php 
//CONNECTION AND ERROR
    $errors ="";
    $db = mysqli_connect('localhost','root','', 'todo');



    //add tasks
    if(isset($_POST['submit'])){
        $task = $_POST['task'];

    //    for ($a = 1; $a <= 10; $a++) {
    //        echo $a;
    //    }

        if(empty($task)){
            $errors = "You must fill in the task";
        }else {
            mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
            header('location: index.php');
        }
    }

    //delete tasks
    if(isset($_GET['del_task'])){
        $id = $_GET['del_task'];
        mysqli_query($db, "DELETE FROM tasks WHERE id= $id");
        header('location: index.php');
    }


    //update task ???????????
    if(isset($_GET['update_task'])){
//buton çıkarıp update
        header('location: index.php');
    }


    $tasks = mysqli_query($db, "SELECT * FROM tasks");
?>






<!DOCTYPE html>
<html>

<head>
    <title> TO-DO APPLICATION</title>
    <link rel= "stylesheet" type="text/css" href= "style.css">
</head>

<body>
    <div class= "heading">
        <h2>       FIRST APPLICATION .. :)</h2>
    </div>


    
    <form method= "POST" action="index.php">
        <?php
            if(isset($errors)){ ?>
            <p><?php echo $errors; ?></p>
        <?php }?>

        <input type = "text" name= "task" class= "task_input">
        <button type = "submit" class="add_btn" name= "submit"> Add Task </button>

    </form>




    <table>
        <thead>
            <tr>
                <th> ORDER </th>
                <th> TASK </th>
                <th> ACTION </th>
            </tr>
        </thead>



        <tbody>

            <?php  $i = 1; while($row = mysqli_fetch_array($tasks)){ ?>
                <tr>
                    <td> <?php echo $i; ?> </td>
                    <td class= "task"><?php echo $row ['task']; ?> </td>
                    <td class = "delete">
                        <a href= "index.php?del_task=<?php echo $row['id']; ?>">x</a>
                    </td>
                </tr>
            <?php $i++; }?>

        </tbody>


    </table>

        
</body>
</html>