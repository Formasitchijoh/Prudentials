<?php
include('config.php');
try {
    // $conn = new PDO("mysql:host=$DB_HOST;dbname=DB_NAME", DB_USER, DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // @ isset is used to check if the variable has been set in this case the $_POST variable
    if(isset($_POST["addtask"])){
        $task = $_POST["task"];
        $dbh -> query("INSERT INTO tasks (task) VALUES ('$task')");
        header("Location: index.php"); // redirect user back to the index page
    }
    if(isset($_GET["delete"])){
        $id = $_GET["delete"];
        $dbh -> query("DELETE FROM tasks WHERE id = '$id'");
        header("Location: index.php");
    }

    if(isset($_GET["complete"])){
        $id = $_GET["complete"];
        $dbh -> query("UPDATE tasks SET status ='completed' WHERE id = '$id'");
        header("Location: index.php");

    }

    $result = $dbh -> query("SELECT * FROM tasks ORDER BY id DESC");

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Todo List</h1>
        <form action="index.php" method="post">
            <input type="text" name="task" placeholder="Enter new task:" id="">
            <button type="submit" name="addtask">Add Task</button>
        </form>
        <ul>
        <?php while($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
            <li class="<?php echo $row["status"]; ?>">
                <strong><?php echo $row["task"]; ?></strong>
                <div class="actions">
                    <a href="index.php?complete=<?php echo $row['id']; ?>">Complete</a>
                    <a href="index.php?delete=<?php echo $row['id']; ?>">Delete</a>
                </div>
            </li>
        <?php endwhile ?>
       </ul>
    </div>
</body>
</html>