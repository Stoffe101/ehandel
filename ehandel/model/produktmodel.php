<?php
class produktmodel{
    private $PDO;

    function __construct()
    {
        $host = 'localhost';
        $dbname = 'ehandel';
        $username = 'root';
        $password = '';
        
        // Skapar en anslutning till databasen med PDO
        $this->PDO = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
    }

    public function Getprodukt()
    {
        // Hämtar alla produkter från databasen
        $query = $this->PDO->query("SELECT * FROM produkter");
        return $query->fetchAll();
    }

    public function getProductById($id)
    {
        // Hämtar en produkt baserat på dess id
        $query = $this->PDO->prepare("SELECT * FROM produkter WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch();
    }
}
?>
