<?php @include 'config.php'; ?>
<?php @include 'header.php'; ?>
<?php session_start(); ?>
<?php
if (isset($_SESSION['admin_name']))
    include "admin_navigation.php";
else
    include "user_navigation.php";
?>
<?php
if (isset($_GET['m_cat'])) {
    $med_cat = $_GET['m_cat'];
}
?>

<form action="" method="post">
    <center>
        <h4><?php echo "This are Records of " . $med_cat . "Medicines."; ?></h4>
    </center>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Medicine Name</th>
                <th>Expiry Date</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Batch Id</th>
                <th>Available Quantity</th>
                <th>Quantity Requested</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $query = "SELECT * FROM medicines WHERE med_category = '$med_cat'";
                $select_posts = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($select_posts)) {
                    $med_id = $row['med_id'];
                    $med_name = $row['med_name'];
                    $med_category = $row['med_category'];
                    $med_date = $row['med_expiryDate'];
                    $med_batchId = $row['med_batchId'];
                    $med_brand = $row['med_brand'];
                    $med_availableQuant = $row['med_availableQuant'];
                    $med_requestedQuant = $row['med_requestedQuant'];
                    $med_status = $row['med_status'];

                ?>



                <?php
                    echo "<td>{$med_id}</td>";
                    echo "<td>{$med_name}</td>";
                    echo "<td>{$med_date}</td>";
                    echo "<td>{$med_category}</td>";
                    echo "<td>{$med_brand}</td>";
                    echo "<td>{$med_batchId}</td>";
                    echo "<td>{$med_availableQuant}</td>";
                    echo "<td>{$med_requestedQuant}</td>";
                    if ($med_requestedQuant)
                        echo "<td>Pending</td>";
                    else
                        echo "<td>Available</td>";
                } ?>
        </tbody>
    </table>

</form>
<?php include "footer.php" ?>