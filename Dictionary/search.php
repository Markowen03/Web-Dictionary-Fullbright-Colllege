<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$database = "dictionary_db";

$connection = new mysqli($servername, $username, $password, $database);

$searchTerm = "";
$results = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $searchTerm = $_POST['searchTerm'];

    $sql = "SELECT * FROM dictionary_table WHERE words LIKE '%$searchTerm%'";
    $result = $connection->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
    } else {
        $errorMessage = "No results found for '$searchTerm'";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ECT DICTIONARY</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        .definition-cell {
            width: 600px;
            font-size: 18px;
            word-wrap: break-word;
            text-align: left;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            background: darkred;
            color: #fff;
            padding: 20px;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
        }
        .social-icon {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }
        .social-icon__link {
            font-size: 1.5rem;
            color: #fff;
            transition: transform 0.3s ease;
        }
        .social-icon__link:hover {
            transform: translateY(-5px);
        }
        .new_student_btn {
            position: absolute;
            top: 10px;
            right: 20px;
        }
        .navbar-fixed {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        body {
            padding-top: 70px;
        }
        .search-bar {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .search-bar .form-control {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .search-bar .btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        .search-results {
            margin-top: 20px;
        }
        .search-results h4 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed">
    <img src="Fullbright_logo_removebg.PNG" alt="" width="80px">
    <a class="navbar-brand" href="#" style="font-size:30px;"><strong>ECT DICTIONARY</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="add.php">Add</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="list.php">List</a>
            </li>
        <div class="new_student_btn">
            <a class="btn btn-warning" href="/Dictionary/user.php" role="button">User</a>
        </div>
        </ul>
    </div>
</nav>

<div class="container my-5">
    <h2 class="text-center">Welcome Admin</h2>

    <form method="post">
        <div class="search-bar">
            <input type="text" class="form-control" placeholder="Enter word to search" name="searchTerm" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </form>

    <?php if (!empty($results)) : ?>
        <div class="search-results">
            <h4>Search Results:</h4>
            <ul class="list-group">
                <?php foreach ($results as $result) : ?>
                    <li class="list-group-item"><?php echo $result['words']; ?> - <?php echo $result['definition']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php elseif (isset($errorMessage)) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><?php echo $errorMessage; ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>

<div class="new_student_btn">
    <a class="btn btn-primary" href="/Dictionary/list.php" role="button">Back</a>
</div>

<footer class="footer">
    <ul class="social-icon">
        <li class="social-icon__item"><a class="social-icon__link" href="https://www.facebook.com/fullbrightcollegeofficial"><i class="fa fa-facebook"></i></a></li>
        <li class="social-icon__item"><a class="social-icon__link" href="#"><i class="fa fa-tiktok"></i></a></li>
        <li class="social-icon__item"><a class="social-icon__link" href="#"><i class="fa fa-twitter"></i></a></li>
        <li class="social-icon__item"><a class="social-icon__link" href="#"><i class="fa fa-instagram"></i></a></li>
    </ul>
    <p>&copy;2024 ECT DEPARTMENT | FULLBRIGHT COLLEGE | All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
