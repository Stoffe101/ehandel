<?php
class kategorimodel{
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

    public function Getkategori()
    {
        // Hämtar alla kategorier från databasen
        $query = $this->PDO->query("SELECT * FROM kategori");
        return $query->fetchAll();
    }

    public function getCategoryName($id)
    {
        // Hämtar kategorins namn baserat på dess id
        $query = $this->PDO->prepare("SELECT name FROM kategori WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetchColumn();
    }

    public function getProductsByCategory($categoryName)
    {
        // Hämtar produkterna som tillhör en viss kategori baserat på kategorins namn
        $query = $this->PDO->prepare("SELECT * FROM produkter WHERE kategori = :categoryName");
        $query->bindParam(':categoryName', $categoryName);
        $query->execute();
        return $query->fetchAll();
    }

    public function getProductsByCategoryId($categoryId)
    {
        // Hämtar produkterna som tillhör en viss kategori baserat på kategorins id
        $query = $this->PDO->prepare("SELECT * FROM produkter WHERE kategori_id = :categoryId");
        $query->bindParam(':categoryId', $categoryId);
        $query->execute();
        return $query->fetchAll();
    }

    public function getCategoryIdByName($categoryName)
    {
        // Hämtar kategorins id baserat på kategorins namn
        $query = $this->PDO->prepare("SELECT id FROM kategori WHERE name = :categoryName");
        $query->bindParam(':categoryName', $categoryName);
        $query->execute();
        return $query->fetchColumn();
    }
}
?>
