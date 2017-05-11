<?php include '../view/header.php'; ?>
<main>
    <h1>Customer Search</h1>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="search_customer">

        <label>Last Name:</label>
        <input type="text" name="lastName" />
        
        <label>&nbsp;</label>
        <input type="submit" value="Search" />
        <br>
    </form>
    <h1>Results</h1>
    <section>
        <!-- display a table of customers -->
        <table>
            <tr>
                <th>Name</th>
                <th>Email Address</th>
                <th>City</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($customers as $customer) : ?>
            <tr>
                <td><?php echo $customer->getFullName(); ?></td>
                <td><?php echo $customer->getEmail(); ?></td>
                <td><?php echo $customer->getCity(); ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="show_edit_form">
                    <input type="hidden" name="customer_ID"
                           value="<?php echo $customer->getCustomerID(); ?>">
                    <input type="submit" value="Select">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>
</main>
<?php include '../view/footer.php'; ?>