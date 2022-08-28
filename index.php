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

    <?php

    //1.Prie duomenu bazes reikia prisijungti
    //2. Kodas turi atlikti SQL uzklausa
    //3.Kodas turi atsijungti nuo duomenu bazes

    class DatabaseConnection {
        private $host = "localhost";
        private $user = "root";
        private $password = "";
        private $database = "parduotuve";

        protected $conn; //connection kad sita savybe galetu naudotis kitos klases

        //Konstruktoriaus funkcija - pasileidzia automatiskai objektui susikurus/ivykdzius objekto metoda
        public function __construct() {
            try {
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
                echo "Prisijungta prie duomenu bazes sekmingai";
            } catch(PDOException $e) {
                echo "Prisijungti prie duomenu bazes nepavyko: " . $e->getMessage();
            }

        }

        //2. Kodas turi atlikti SQL uzklausa

        // $col - rikiavimo stulpelis (id, title, description)
        // $sortDir - rikiavimo kryptis (ASC, DESC)

        // SELECT - grazina rezultatu masyva

        // INSERT - negrazina jokiu irasu
        // DELETE - negrazina jokiu irasu
        // UPDATE - negrazina jokiu irasu

        //SELECT * FROM `categories` WHERE 1;

        public function selectAction($table, $col = "id", $sortDir = "ASC") {
            try {
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM `$table` WHERE 1 ORDER BY $col $sortDir";
                //pasiruosimas vykdyti
                $stmt = $this->conn->prepare($sql);
                //vykdyti
                $stmt->execute();

                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetchAll();

                var_dump($result);

            } catch(PDOException $e) {
                echo "Nepavyko vykdyti uzklausos: " . $e->getMessage();
            }
        }

        //$cols - iterpiami stulpeliai, masyvas
        //$values - iterpiamos reiksmes

        public function insertAction($table, $cols, $values) {
            try {
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO `$table` (`title`, `description`, `price`, `category_id`, `image_url`) VALUES ('test','test','test','1','test')";
                $this->conn->exec($sql);
                echo "Pavyko sukurti nauja irasa";
            } catch (PDOException $e) {
                echo "Nepavyko sukurti naujo iraso: " . $e->getMessage();
            }
        }

        //3.Kodas turi atsijungti nuo duomenu bazes
        public function __destruct() {
            $this->conn = null;
            echo "Atjungta is duomenu bazes sekmingai";
        }

    }

    $conn = new DatabaseConnection();
    $conn->selectAction("categories");
    $conn->selectAction("products");
    $conn->insertAction("products");
    ?>

   

</body>

</html>