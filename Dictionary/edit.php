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

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: /Dictionary/list.php");
        exit;
    }

    $id = $_GET['id'];

    $sql = "SELECT * FROM dictionary_table WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /Dictionary/list.php");
        exit;
    }

    $words = $row["words"];
    $definition = $row["definition"];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST["ID"];
    $words = $_POST["words"];
    $definition = $_POST["definition"];

    if (empty($id) || empty($words) || empty($definition)) {
        $errorMessage = "All fields are required";
    } else {
        $sql = "UPDATE dictionary_table SET words='$words', definition='$definition' WHERE id=$id";

        if ($connection->query($sql) === TRUE) {
            $successMessage = "Word updated successfully";
            // Redirect after updating
            header("location: /Dictionary/list.php");
            exit;
        } else {
            $errorMessage = "Error updating record: " . $connection->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECT DICTIONARY</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #343a40 !important;
        }

        .navbar-brand {
            font-size: 30px;
        }

        .alert {
            margin-top: 20px;
        }

        .form-control {
            border-radius: 0;
        }

        .btn {
            border-radius: 0;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .back_btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <img src="Fullbright_logo_removebg.PNG" alt="" width="80px">
        <a class="navbar-brand" href="#" style="font-size: 30px;"><strong>ECT DICTIONARY</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="search.php">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add.php">Add</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="list.php">List <span class="sr-only"></span></a>
                </li>
            </ul>
        </div>
        <div class="back_btn">
            <a class="btn btn-danger" href="/Dictionary/list.php" role="button">Back</a>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="text-center">Edit Word</h2>

        <?php if (!empty($errorMessage)) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo $errorMessage; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form method="post">
            <input type="hidden" name="ID" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Word</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="words" value="<?php echo htmlspecialchars($words); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Definition</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="definition" value="<?php echo htmlspecialchars($definition); ?>">
                </div>
            </div>

            <?php if (!empty($successMessage)) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?php echo $successMessage; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
