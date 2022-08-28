<?php
include("classes/databaseConnection-class.php");

class ProductsDatabase extends DatabaseConnection {
    public $products;

    public function __construct(){
        parent::__construct();
        $this->products = $this->selectAction("products", "category_id", "ASC");
        if(!isset($_GET["page"])) {
            foreach ($this->products as $product) {
                echo "<tr>";
                echo "<td>" . $product["id"]."</td>";
                echo "<td>" . $product["title"]."</td>";
                echo "<td>" . $product["description"]."</td>";
                echo "<td>" . $product["price"]."</td>";
                echo "<td>" . $product["category_id"]."</td>";
                echo "<td>" . $product["image_url"]."</td>";
                echo "</tr>";
            }
        }
    }
}

?>