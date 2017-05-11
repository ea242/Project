<?php include '../view/header.php'; ?>
<main>
    <h1>Customer Login</h1>
    <p>You must login before you can register product.</p>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="customer_verify">

        <label>Email:</label>
        <input type="text" name="email" />
        
        <label>&nbsp;</label>
        <input type="submit" value="Login" />
        <br>
    </form>
</main>
<?php include '../view/footer.php'; ?>