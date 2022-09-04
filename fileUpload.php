<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="fileUpload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <button type="submit" name="submit">Upload</button>
    </form>

    <?php
    // failo patalpinimas serveryje
    // failo pavadinima turime irasyti i DB

    $fileDir = "images/"; 

    if(isset($_POST["submit"])) {
        // pilnas kelias iki failo
        $fileTarget = $fileDir . basename($_FILES["file"]["name"]);
        // failo tipas
        $fileType = strtolower(pathinfo($fileTarget, PATHINFO_EXTENSION));

        // formato tikrinimas
        // if ($fileType != "jpg") {
        //     echo "Failas turi būti JPG";
        // }

        if($_FILES["file"]["error"] == 0) {
            // jei pavyko tai ikelia ir grazina true
            // jeigu ne, grazina false
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $fileTarget)) {
                echo "Failas įkeltas sėkmingai";
            } else {
                echo "Failo įkelti nepavyko";
            }
        }


        var_dump($_FILES["file"]);
    }
    ?>

</body>
</html>