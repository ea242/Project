<?php include '../view/header.php'; ?>
<main>
    <h1>Technicians List</h1>

    <section>
        <!-- display a table of techs -->
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Password</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($technicians as $technician) : ?>
            <tr>
                <td><?php echo $technician->getFirstName(); ?></td>
                <td><?php echo $technician->getLastName(); ?></td>
                <td><?php echo $technician->getEmail(); ?></td>
                <td><?php echo $technician->getPhone(); ?></td>
                <td><?php echo $technician->getPassword(); ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="delete_technician">
                    <input type="hidden" name="techID"
                           value="<?php echo $technician->getTechID(); ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="?action=show_add_form">Add Technician</a></p>
    </section>
</main>
<?php include '../view/footer.php'; ?>