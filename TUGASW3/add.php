<?php
include_once("config.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $publisher = $_POST['publisher'];
    $count = $_POST['count'];
    
    // Handle file upload
    $picture = $_FILES['picture']['name'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES['picture']['name']);
    
    if (move_uploaded_file($_FILES['picture']['tmp_name'], $target_file)) {
        // Insert data into table
        $result = mysqli_query($mysqli, "INSERT INTO library(name, category, publisher, count, picture) VALUES('$name', '$category', '$publisher', '$count', '$picture')");
        
        if ($result) {
            echo "<script>alert('Data added successfully!'); window.location.href='index.php';</script>";
        } else {
            echo "Error: " . mysqli_error($mysqli);
        }
    } else {
        echo "Error uploading file.";
    }
}
?>

<html>
<head>
    <title>Add New Book</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Add New Book</h2>
        <form action="add.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Category:</label>
                <input type="text" name="category" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Publisher:</label>
                <input type="text" name="publisher" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Count:</label>
                <input type="number" name="count" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Picture:</label>
                <input type="file" name="picture" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Add</button>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
