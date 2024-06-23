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
        .navbar-fixed {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        body {
            padding-top: 56px; 
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
            <li class="nav-item active">
                <a class="nav-link" href="user.php">Search <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user_list.php">List</a>
            </li>
        <div class="new_student_btn">
            <a class="btn btn-primary" href="/Dictionary/user.php" role="button">Back</a>
        </div>
        </ul>
    </div>
</nav>

<div class="container my-5">
  <center><h2>List of Words</h2></center></br></br>
    <center><table class="table table-striped table-hover" id="myTable"></center>
        <thead>
            <tr>
                <th class="text-center" scope="col">Words</th>
                <th class="text-center" scope="col">Definition</th>
            </tr> 
        </thead>
        <tbody>
        <?php
        //Connection to Database
        $servername = "localhost:3306";
        $username = "root";
        $password = "";
        $database = "dictionary_db";

        $connection = new mysqli($servername, $username, $password, $database);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $sql = "SELECT * FROM dictionary_table";
        $result = $connection->query($sql);

        if (!$result) {
            die("Invalid query: " . $connection->error);
        }

        //Read data of each row
        while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
                <td class='text-center'>$row[words]</td>
                <td class='text-center definition-cell'>$row[definition]</td>
            ";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap Modal for Confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this word?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes</button>
      </div>
    </div>
  </div>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteButtons = document.querySelectorAll('.delete-button');
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        var confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        var wordIdToDelete;

        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                wordIdToDelete = this.getAttribute('data-id');
                deleteModal.show();
            });
        });

        confirmDeleteBtn.addEventListener('click', function() {
            window.location.href = '/Dictionary/delete.php?id=' + wordIdToDelete;
        });
    });
</script>
</body>
</html>
