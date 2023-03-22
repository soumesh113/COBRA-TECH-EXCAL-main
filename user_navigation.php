<?php
$username = $_SESSION['user_name'];
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active"> Welcome <?php echo $username; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="/homepage.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/account.php">Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/addMedicine.php">Donate Medicine </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/users_medicines.php">Request Medicine </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/users_req_med.php">Requested Medicine </a>
                </li>

            </ul>


            <a href="logout.php"><button class="btn btn-danger" button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signUpModal">log out </button></a>
        </div>
    </div>
    </div>
</nav>