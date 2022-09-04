<?php

include ("classes/databaseConnection-class.php");

class ShopDatabase extends DatabaseConnection {
    public $products;
    public $categories;

    public function __construct() {
        parent::__construct();
    }


    public function getProducts() {

        if(isset($_GET["sortCol"]) && isset($_GET["sortDir"])) {
            $sortCol = $_GET["sortCol"];
            $sortDir = $_GET["sortDir"];
        } else {
            $sortCol = "id";
            $sortDir = "ASC";
        }
        $this->products = $this->selectWithJoin("products","categories","category_id","id","LEFT JOIN",["products.id", "products.title", "products.description", "products.price", "products.image_url", "categories.title AS categoryTitle"], $sortCol, $sortDir);
        return $this->products;
    }

    public function getCategories() {
        $this->categories = $this->selectAction("categories");
        return $this->categories;
    }

    public function createProduct() {
        if(isset($_POST["submit"])) {
            $product = array(
                "title" => $_POST["title"],
                "description" => $_POST["description"],
                "price" => $_POST["price"],
                "category_id" => $_POST["category_id"],
                "image_url" => $this->uploadImage($_FILES["image_url"])
            );
            $this->insertAction("products", ["title","description","price","category_id","image_url"], ["'".$product["title"]."'", "'".$product["description"]."'", "'".$product["price"]."'", "'".$product["category_id"]."'", "'".$product["image_url"]."'"]);
        }
    }

    // metodas naudojamas kito metodo viduje
    private function uploadImage($file) {
        //var_dump($file);
        $fileDir = "images/";
        $fileTarget = $fileDir . basename($file["name"]);
        $fileType = strtolower(pathinfo($fileTarget, PATHINFO_EXTENSION));

        // formato tikrinimas
        // if ($fileType != "jpg") {
        //     echo "Failas turi būti JPG";
        // }

        if ($file["error"] == 0) {
            if (move_uploaded_file($file["tmp_name"], $fileTarget)) {
                return $fileTarget;
            } else {
                return "images\christopher-bill-5gSAWojmSpQ-unsplash.jpg";
            }
        }
        return $fileTarget;
    }
}

?>