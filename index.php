<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parduotuve</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>

<!-- 1. Sukurti naują duomenų bazę "parduotuve".
2. Sukurti duomenų bazės lentelę "products"
id
title(string)
description(longText)
price(float).
category_id(int)
image_url(string)
3. Sukurti duomenų bazės lentelę "categories"
id
title(string)
description(longText)
4. Sudaryti ryšį: products.category_id-> categories.id(Produktas priklauso kategorijai)
5. Užpildyti kategorijas 3 netikromis kategorijomis.
6. Užpildyti 150 netikrų produktų.(Sukurti PHP scriptą,kuris į produktų lentelę įrašytų 150 atsitiktinių produktų ir priskirtų kategoriją)
7. Produktams sukurti index.php, create.php, edit.php ir sukurti CRUD operacijas(naujo produkto įkėlimas, ištrynimas, redagavimas, visų peržiūra). Turi būti galimybė įkelti paveiksliuką.
8. Kategorijoms sukurti index.php, create.php, edit.php ir sukurti CRUD operacijas.
9. Produktams sukurti rikiavimą TIK pagal kategorijos pavadinimą.
10. Produktams sukurti filtravimą pagal kategoriją.
11. Sukurti kategorijų rikiavimą pagal visus stulpelius(id, title, description)

PS. Remtis paskaitos kodu -->

<body>
    <div class="container">
        <ul class="nav">
            <li class="nav-item fs-5">
                <a class="nav-link" href="index.php">Pagrindinis</a>
            </li>
            <li class="nav-item fs-5">
                <a class="nav-link" href="index.php?page-create">Naujas produktas</a>
            </li>
            <li class="nav-item fs-5">
                <a class="nav-link" href="index.php?page=update">Redaguoti produktą</a>
            </li>
        </ul>

        <?php

        //pagal GET kintamaji mes busime nukreipiami į tam tikrus puslapius

        if (isset($_GET["page"])) {
            if (($_GET["page"]) == "create") {
                include("products/create.php");
            } else if (($_GET["page"]) == "update") {
                include("products/update.php");
            }
        } else {
            include("products/index.php");
        }

        ?>

    </div>

</body>

</html>