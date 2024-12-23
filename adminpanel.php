<?php
require 'files/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

       <!-- Table -->
       <div class="container mt-5">
        <h2 class="mb-4">Reservations</h2>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone No.</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Persons</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM `booking`";
                $result=mysqli_query($conn,$sql);
                if ($result) {
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $sno = $row['s.no'];
                        $name = $row['name'];
                        $phone = $row['phone'];
                        $date = $row['date'];
                        $time = $row['time'];
                        $persons = $row['persons'];
                        $email = $row['email'];
                        echo "<tr>
                                <th scope='row'>$sno</th>
                                <td>$name</td>
                                <td>$phone</td>
                                <td>$date</td>
                                <td>$time</td>
                                <td>$persons</td>
                                <td>$email</td>
                                <td>
                                    <a href='update.php?sno=$sno' class='btn btn-warning btn-sm'>Update</a>
                                    <a href='delete.php?sno=$sno' class='btn btn-danger btn-sm'>Delete</a>
                                </td>
                            </tr>";
                    }
                }
                ?>

            </tbody>
        </table>
    </div> 

    <!-- Bootstrap JS and dependencies -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>