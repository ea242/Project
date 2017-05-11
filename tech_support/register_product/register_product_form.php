<?php include '../view/header.php'; ?>
<main>
    <h1>Register Product</h1>
    <form action="index.php" method="post" id="aligned">
        <input type="hidden" name="action" value="register_product">
        <input type="hidden" name="customerID" value="<?php echo $customer->getCustomerID();?>">
        <label>Customer:</label>
        <input type="text" name="fullName" disabled value="<?php echo $customer->getFullName();?>"/>

        <br>
        <label>Product:</label>
        <select name="productID">
            <?php foreach ($products as $product) : ?>
            <option value="<?php echo $product->getProductCode(); ?>"><?php echo $product->getName(); ?></option>
            <?php endforeach; ?>
        </select>
        
        <br>
        <label>&nbsp;</label>
        <input type="submit" value="Register Product" />
        <br>
    </form>
</main>
<?php include '../view/footer.php'; ?>