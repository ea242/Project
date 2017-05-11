<?php include '../view/header.php'; ?>
<main>
    <h1>Get Customer</h1>
    <p>You must enter the customer's email address to select customer.</p>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="customer_get">

        <label>Email:</label>
        <input type="text" name="email" />
        
        <label>&nbsp;</label>
        <input type="submit" value="Get Customer" />
        <br>
    </form>
</main>
<?php include '../view/footer.php'; ?>