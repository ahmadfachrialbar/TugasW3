<?php
// Create database connection using config file
include_once("config.php");

// Define how many results you want per page
$results_per_page = 10;

// Find out the number of results stored in the database
$result = mysqli_query($mysqli, "SELECT * FROM library");
$number_of_results = mysqli_num_rows($result);

// Determine number of total pages available
$number_of_pages = ceil($number_of_results / $results_per_page);

// Determine which page number visitor is currently on
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Determine the SQL LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page - 1) * $results_per_page;

// Retrieve selected results from database
$result = mysqli_query($mysqli, "SELECT * FROM library ORDER BY id DESC LIMIT $this_page_first_result, $results_per_page");
?>

<html>
<head>
    <title>Homepage</title>
    <body style="background-color: white">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <br>
    <div class="container">
        <button type="button" class="btn btn-primary" onclick="location.href='add.php'">Add New User</button><br /><br />

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Picture</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Publisher</th>
                    <th scope="col">Count</th>
                    <th scope="col">Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = $this_page_first_result + 1;
                while ($user_data = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $no . "</td>";
                    $no++;
                    echo "<td><img src='images/" . $user_data['picture'] . "' width='50'></td>";
                    echo "<td>" . $user_data['name'] . "</td>";
                    echo "<td>" . $user_data['category'] . "</td>";
                    echo "<td>" . $user_data['publisher'] . "</td>";
                    echo "<td>" . $user_data['count'] . "</td>";
                    echo "<td><a href='edit.php?id=" . $user_data['id'] . "'>Edit</a> | <a href='delete.php?id=" . $user_data['id'] . "'>Delete</a></td></tr>";
                }
                ?>
            </tbody>
        </table>

        <nav>
            <ul class="pagination">
                <?php for ($page = 1; $page <= $number_of_pages; $page++) {
                    echo "<li class='page-item'><a class='page-link' href='index.php?page=" . $page . "'>" . $page . "</a></li>";
                } ?>
            </ul>
        </nav>
    </div>
</body>
</html>
