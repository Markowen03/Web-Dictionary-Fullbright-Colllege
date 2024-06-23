<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$database = "dictionary_db";

$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$words = "";
$definition = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST["id"];
  $words = $_POST["words"];
  $definition = $_POST["definition"];

  do {
    if (empty($words) || empty($definition)) {
      $errorMessage = "All the fields are required";
      break;
    }

    // Add new words to dictionary
    $sql = "INSERT INTO dictionary_table (id, words, definition) VALUES ('$id', '$words', '$definition')";
    $result = $connection->query($sql);

    if (!$result) {
      $errorMessage = "Invalid query: " . $connection->error;
      break;
    }

    $id = "";
    $words = "";
    $definition = "";

    $successMessage = "Word Successfully Added";

    header("location: /Dictionary/add.php?successMessage=" . urlencode($successMessage));
    exit;

  } while (false);
}

if (isset($_GET['successMessage'])) {
  $successMessage = $_GET['successMessage'];
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
            position: relative;
            width: 100%;
            background: darkred;
            min-height: 5px;
            padding: 20px 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .social-icon, .menu {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px 0;
            flex-wrap: wrap;
        }
        .social-icon__item, .menu__item {
            list-style: none;
        }
        .social-icon__link {
            font-size: 2rem;
            color: #fff;
            margin: 0 10px;
            display: inline-block;
            transition: 0.5s;
        }
        .social-icon__link:hover {
            transform: translateY(-10px);
        }
        .menu__link {
            font-size: 1.2rem;
            color: #fff;
            margin: 0 10px;
            display: inline-block;
            transition: 0.5s;
            text-decoration: none;
            opacity: 0.75;
            font-weight: 300;
        }
        .menu__link:hover {
            opacity: 1;
        }
        .footer p {
            color: #fff;
            margin: 15px 0 10px 0;
            font-size: 1rem;
            font-weight: 300;
        }
        .new_student_btn {
            position: absolute;
            top: 0;
            right: 0;
            margin: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <img src="Fullbright_logo_removebg.PNG" alt="" width="80px">
    <a class="navbar-brand" href="#" style="font-size:30px;"><strong>ECT DICTIONARY</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="search.php">Search <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add.php">Add</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="list.php">List</a>
            </li>
        </ul>
        <div class="new_student_btn">
            <a class="btn btn-primary" href="/Dictionary/search.php" role="button">Back</a>
        </div>
    </div>
</nav>

<div class="container my-5" style="padding-bottom: 200px;">
    <center>
        <h2>Add Words</h2>
    </center>
    <br><br>
    <?php
    if (!empty($errorMessage)) {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }

    if (!empty($successMessage)) {
        echo "
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>$successMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
    ?>

    <form method="post" enctype="multipart/form-data">

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Words</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="words" value="<?php echo $words; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Definition</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="definition" value="<?php echo $definition; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-danger" href="/Dictionary/list.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>

<footer class="footer">
    <ul class="social-icon">
        <li class="social-icon__item"><a class="social-icon__link" href="https://www.facebook.com/fullbrightcollegeofficial"><ion-icon name="logo-facebook"></ion-icon></a></li>
        <li class="social-icon__item"><a class="social-icon__link" href="#"><ion-icon name="logo-tiktok"></ion-icon></a></li>
        <li class="social-icon__item"><a class="social-icon__link" href="#"><ion-icon name="logo-twitter"></ion-icon></a></li>
        <li class="social-icon__item"><a class="social-icon__link" href="#"><ion-icon name="logo-instagram"></ion-icon></a></li>
    </ul>
    <p>&copy;2024 ECT DEPARTMENT | FULLBRIGHT COLLEGE | All Rights Reserved</p>
</footer>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
