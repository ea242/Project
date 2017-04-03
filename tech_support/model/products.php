<?php
function get_products() {
    global $db;
    $query = 'SELECT * FROM tech_products ORDER BY productCode';
    $statement = $db->prepare($query);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}
/*
function get_product($product_id) {
    global $db;
    $query = 'SELECT * FROM products
              WHERE productID = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(":product_id", $product_id);
    $statement->execute();
    $product = $statement->fetch();
    $statement->closeCursor();
    return $product;
}*/

function delete_product($product_id) {
    global $db;
    $query = 'DELETE FROM tech_products
              WHERE productCode = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();
}
function add_product($code, $name, $version, $releaseDate) {
    global $db;
    $query = 'INSERT INTO products
                 (productCode, name, version, releaseDate)
              VALUES
                 (:code, :name, :price, :reDate)';
    $statement = $db->prepare($query);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':ver', $version);
    $statement->bindValue(':reDate', $releaseDate);
    $statement->execute();
    $statement->closeCursor();
}
?>