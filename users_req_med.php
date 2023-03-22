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
$username = $_SESSION['user_name'];
$query = "SELECT * FROM user_form WHERE username = '{$username}'";
$select_user_query = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($select_user_query)) {
    $user_id = $row['user_Id'];
}

?>
<?php
if (isset($_GET['delete'])) {
    $the_order_Id = $_GET['delete'];
    $query = "DELETE FROM order_list WHERE order_Id ={$the_order_Id}; ";
    $delete_query = mysqli_query($conn, $query);
}
?>


<form action="" method="post">

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th>Id</th>
                <th>Medicine Name</th>
                <th>Expiry Date</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Requested Quantity</th>
                <th>Status</th>
                <th>Cancel/Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $username = $_SESSION['user_name'];
                $query = "SELECT * FROM user_form WHERE username = '{$username}'";
                $select_user_query = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($select_user_query)) {
                    $the_user_id = $row['user_Id'];
                }

                $query = "SELECT * FROM medicines m JOIN order_list o ON m.med_Id = o.order_med_Id
             AND o.order_user_Id = {$the_user_id}";



                $select_posts = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($select_posts)) {
                    $med_id = $row['med_id'];
                    $order_id = $row['order_Id'];
                    $med_name = $row['med_name'];
                    $med_category = $row['med_category'];
                    $med_date = $row['med_expiryDate'];
                    $med_brand = $row['med_brand'];
                    $order_quant = $row['quant_order'];
                    $order_status = $row['order_status'];

                ?>
                    <?php
                    if (isset($_GET['cancel'])) {
                        $the_order_Id = $_GET['cancel'];
                        $query = "DELETE FROM order_list WHERE order_Id={$the_order_Id}";
                        $cancel_query = mysqli_query($conn, $query);
                        $query = "UPDATE medicines SET med_requestedQuant = med_requestedQuant -  $order_quant WHERE med_id = $med_id";
                        $update_query = mysqli_query($conn, $query);
                        // header("Location : users_req_med.php");
                    }

                    ?>
                    <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $med_id; ?>"></td>

                <?php
                    echo "<td>{$med_id}</td>";
                    echo "<td>{$med_name}</td>";
                    echo "<td>{$med_date}</td>";
                    echo "<td>{$med_category}</td>";
                    echo "<td>{$med_brand}</td>";
                    echo "<td>{$order_quant}</td>";
                    echo "<td>$order_status</td>";
                    if ($order_status === 'Pending')
                        echo "<td><a href='users_req_med.php?cancel={$order_id}'>Cancel</a></td>";
                    else
                        echo "<td><a href='users_req_med.php?delete={$order_id}'>Delete</a></td>";
                    echo "</tr>";
                } ?>
        </tbody>
    </table>

</form>
<?php include "footer.php" ?>