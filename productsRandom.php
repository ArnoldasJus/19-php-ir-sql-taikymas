<?php

// 1. prisijungti prie DB
// 2. Sukurti 150 produktu

include ("classes/databaseConnection-class.php");

for($i=0; $i<150; $i++) {
    $conn = new DatabaseConnection();
    $conn->insertAction("products", ["title","description","price","category_id","image_url"], ["'product$i'", "'description$i'", "'".rand(1,1000)."'", "'".rand(1,3)."'", "'https://images.unsplash.com/photo-1630448927918-1dbcd8ba439b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'"]);
}

?>