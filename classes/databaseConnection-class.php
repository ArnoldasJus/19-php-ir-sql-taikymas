 <?php

    //1.Prie duomenu bazes reikia prisijungti
    //2. Kodas turi atlikti SQL uzklausa
    //3.Kodas turi atsijungti nuo duomenu bazes

    class DatabaseConnection
    {
        private $host = "localhost";
        private $user = "root";
        private $password = "";
        private $database = "parduotuve";

        protected $conn; //connection kad sita savybe galetu naudotis kitos klases

        //Konstruktoriaus funkcija - pasileidzia automatiskai objektui susikurus/ivykdzius objekto metoda
        public function __construct()
        {
            try {
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
                //echo "Prisijungta prie duomenu bazes sekmingai";
            } catch (PDOException $e) {
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

        public function selectAction($table, $col = "id", $sortDir = "ASC")
        {
            try {
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM `$table` WHERE 1 ORDER BY $col $sortDir";
                //pasiruosimas vykdyti
                $stmt = $this->conn->prepare($sql);
                //vykdyti
                $stmt->execute();

                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetchAll();

                return $result;
            } catch (PDOException $e) {
                return "Nepavyko vykdyti uzklausos: " . $e->getMessage();
            }
        }

        //$cols - iterpiami stulpeliai, masyvas
        //$values - iterpiamos reiksmes

        //products
        //$cols - [title, description, price, category_id, image_url]
        //$values - [test, test, rand(0, 5000), rand(1, 3), test]

        //categories
        //$cols - ["title", "description"]
        //$values - ["'test'", "'test'"]
        public function insertAction($table, $cols, $values)
        {

            //masyva pavercia i teksta per skirtuka (delimeter) ["title", "description"] => "title, description"
            $cols = implode(",", $cols);
            $values = implode(",", $values);


            try {
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO `$table` ($cols) VALUES ($values)";
                var_dump($sql);
                $this->conn->exec($sql);
                echo "Pavyko sukurti nauja irasa";
            } catch (PDOException $e) {
                echo "Nepavyko sukurti naujo iraso: " . $e->getMessage();
            }
        }

        //3.Kodas turi atsijungti nuo duomenu bazes
        public function __destruct()
        {
            $this->conn = null;
            //echo "Atjungta is duomenu bazes sekmingai";
        }
    }

?>