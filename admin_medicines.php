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
if (isset($_GET['approve'])) {
    $medValueId = $_GET['approve'];
    $query = "UPDATE medicines SET med_availableQuant = med_availableQuant - med_requestedQuant  WHERE med_id={$medValueId}";
    $update_to_published_status = mysqli_query($conn, $query);
    $query = "UPDATE medicines SET med_requestedQuant = 0 WHERE med_id={$medValueId}";
    $update_to_published_status = mysqli_query($conn, $query);
    $query = "UPDATE order_list SET order_status = 'Approve' WHERE order_med_Id={$medValueId}";
    $update_order_status = mysqli_query($conn, $query);
}
if (isset($_GET['unapprove'])) {
    $medValueId = $_GET['unapprove'];
    $query = "UPDATE medicines SET med_requestedQuant = 0 WHERE med_id={$medValueId}";
    $unapprove_query = mysqli_query($conn, $query);
}

?>
<?php
if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $medValueId) {

        $bulk_option = $_POST['bulk_options'];
        switch ($bulk_option) {

            case 'approve':
                $query = "UPDATE medicines SET med_availableQuant = med_availableQuant - med_requestedQuant  WHERE med_id={$medValueId}";
                $update_to_published_status = mysqli_query($conn, $query);
                $query = "UPDATE medicines SET med_requestedQuant = 0 WHERE med_id={$medValueId}";
                $update_to_published_status = mysqli_query($conn, $query);
                break;

            case 'unapprove':
                $query = "UPDATE medicines SET med_requestedQuant = 0 WHERE med_id={$medValueId}";
                $delete_query = mysqli_query($conn, $query);
                break;
        }
    }
}
?>

<form action="" method="post">
    <div id="bulkOptionsContainer" class="col-xs-4">

        <select class="form-control" name="bulk_options" id="">
            <option value="">Select Options</option>
            <option value="approve">Approve</option>
            <option value="unapprove">Unapprove</option>
        </select>
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th>Id</th>
                <th>Medicine Name</th>
                <th>Expiry Date</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Batch Id</th>
                <th>Available Quantity</th>
                <th>Quantity Requested</th>
                <th>Status</th>
                <th>Approve</th>
                <th>Unapprove</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $query = "SELECT * FROM medicines ORDER BY med_id DESC";
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

                    <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $med_id; ?>"></td>

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
                    if ($med_requestedQuant) {
                        echo "<td><a href='admin_medicines.php?approve={$med_id}'>Approve</a></td>";
                        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to reject the request?');\" href='admin_medicines.php?unapprove={$med_id}'>Unapprove</a></td>";
                        echo "</tr>";
                    } else {
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "</tr>";
                    }
                } ?>
        </tbody>
    </table>

</form>
<?php include "footer.php" ?>