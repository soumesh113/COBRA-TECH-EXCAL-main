<?php session_start(); ?>
<?php include "header.php"; ?>
<?php
if (isset($_SESSION['admin_name']))
    include "admin_navigation.php";
else
    include "user_navigation.php";
?>

<?php

@include 'config.php';


if (isset($_POST['add'])) {

    $med_name = $_POST['name'];
    $med_expiryDate = date('Y-m-d', strtotime($_POST['expiredDate']));
    $med_category = $_POST['category'];
    $med_batchId = $_POST['batchId'];
    $med_brand = $_POST['brand'];
    $med_quantity = $_POST['quantity'];

    $query = " INSERT INTO medicines(med_name,med_expiryDate,med_category,med_batchId,med_brand,med_availableQuant,med_status) VALUES('{$med_name}','$med_expiryDate','{$med_category}','{$med_batchId}','{$med_brand}',$med_quantity,'Pending') ";

    $result = mysqli_query($conn, $query);
    $prev_Id = mysqli_insert_id($conn);
    // $_SESSION['{$prev_Id+1}'] = array('0');
    // $_SESSION['request_amount'] = array('0');
}

?>



<div class="form-container">

    <form action="" method="post">
        <h3>Add Medicine</h3>
        <input type="text" name="name" required placeholder="Medicine name">
        <input type="date" min=<?php echo 'now()'; ?> name="expiredDate" required placeholder="dd/mm/yyyy">
        <select name="category">
            <option value="">Select Category</option>
            <option value="Antibiotics">Antibiotics</option>
            <option value="Antiseptic">Antiseptic</option>
            <option value="Antiseptic">Antiseptic</option>
            <option value="Antiseptic">Antiseptic</option>
        </select>
        <input type="text" name="batchId" required placeholder="Batch id">
        <input type="text" name="brand" required placeholder="Brand">
        <input type="number" name="quantity" required placeholder="Amount">
        <input type="text" name="pickUpAddress" required placeholder="Address">
        <input type="submit" name="add" value="Add" class="form-btn">
        <p> <a href="#">Close</a></p>
    </form>

</div>
<?php include "footer.php"; ?>