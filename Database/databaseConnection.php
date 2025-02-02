
<?php 

class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $name = 'projekti';

    function startConnection(){
        try{
            $conn = new PDO(
                "mysql:host=$this->host;dbname=$this->name",
                $this->username,
                $this->password
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $conn;

        }catch(PDOException $e){
            echo 'Database Connection Error: ' . $e->getMessage();
            return null;
        }
    }

}

?>