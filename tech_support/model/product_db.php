<?php
class ProductDB {

    function get_products() {
        $db = Database::getDB();
        $query = 'SELECT * FROM tech_products ORDER BY productCode';
        $result = $db->query($query);
        $products = array();
        foreach ($result as $row) {
            $product = new Product($row['productCode'],
                                   $row['name'],
                                   $row['version'],
                                   $row['releaseDate']);
            $products[] = $product;
        }
        Database::closeDB();
        return $products;
    }

    function get_product_registered($customerID) {
        $db = Database::getDB();
        $query = "SELECT * FROM tech_products, registrations WHERE registrations.customerID = '$customerID' and tech_products.productCode = registrations.productCode;";
        $result = $db->query($query);
        $products = array();
        foreach ($result as $row) {
            $product = new Product($row['productCode'],
                                   $row['name'],
                                   $row['version'],
                                   $row['releaseDate']);
            $products[] = $product;
        }
        Database::closeDB();
        return $products;
    }

    function set_product_registered($customerID, $productID) {
        $db = Database::getDB();
        $date = "2017-05-11";
        $query =
            "INSERT INTO registrations
                 (customerID, productCode, registrationDate)
             VALUES
                 ('$customerID', '$productID', '$date')";

        $row_count = $db->exec($query);

        Database::closeDB();
    }

    public static function deleteProduct($productCode) {
        $db = Database::getDB();
        $query = "DELETE FROM tech_products
                  WHERE productCode = '$productCode'";
        $row_count = $db->exec($query);
        Database::closeDB();
        return $row_count;
    }

    public static function addProduct($product) {
        $db = Database::getDB();

        $code = $product->getProductCode();
        $name = $product->getName();
        $version = $product->getVersion();
        $date = $product->getReleaseDate();

        $query =
            "INSERT INTO tech_products
                 (productCode, name, version, releaseDate)
             VALUES
                 ('$code', '$name', '$version', '$date')";

        $row_count = $db->exec($query);
        Database::closeDB();
        return $row_count;
    }
}
?>