<?php include '../view/header.php'; ?>
<main>
    <h1>Product List</h1>

    <section>
        <!-- display a table of products -->
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Version</th>
                <th>Release Date</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo $product->getProductCode(); ?></td>
                <td><?php echo $product->getName(); ?></td>
                <td><?php echo $product->getVersion(); ?></td>
                <td><?php echo $product->getReleaseDate(); ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="delete_product">
                    <input type="hidden" name="product_id"
                           value="<?php echo $product->getProductCode(); ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="?action=show_add_form">Add Product</a></p>
    </section>
</main>
<?php include '../view/footer.php'; ?>