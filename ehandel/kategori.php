<html>
<head>
    <title>E-handel</title>

    <link rel="stylesheet" href="main.css">
    <meta charset="UTF-8">
</head>

<body>
<nav>
    <ul>
        <li>
            <a href="index.php">Hem</a>
        </li>
        <li>
            <a href="produkter.php">Produkter</a>
        </li>
        <li>
            <a href="kategorier.php">Kategorier</a>
        </li>
        <li>
            <a href="kundvagn.php">Kundvagn</a>
        </li>
    </ul>
</nav>

<main>
<?php
    // Hämta kategorins ID från URL-parametern 'categoryId'
    $id = $_GET['categoryId'];

    // Kontrollera om ID:t är satt
    if (isset($id)) {
        // Inkludera kategorimodellen
        require 'model/kategorimodel.php';

        // Skapa en instans av kategorimodellen
        $kategorimodel = new kategorimodel();

        // Hämta kategorinamnet baserat på ID:t
		$categoryName = $kategorimodel->getCategoryName($id);

		// Hämta produkterna i den valda kategorin
		$produkter = $kategorimodel->getProductsByCategory($categoryName);

        ?>
        <!-- Visa kategorinamnet som en rubrik -->
        <h2 class="flex centered">Alla produkter i kategori <?php echo $categoryName; ?></h2>
        <div class="featured">
        <?php

        // Loopa genom produkterna och visa dem som produktkort
        foreach ($produkter as $produkt) {
            ?>

            <div class="product-card">
                <img src="bilder/<?php echo $produkt['img']; ?>">
                <h2><?php echo $produkt['namn']; ?></h2>
                <p><?php echo $produkt['description']; ?></p>
                <form action="kategori.php" method="GET">
                    <!-- Skicka med categoryId som en dold input i formuläret -->
				    <input type="hidden" name="categoryId" value="<?php echo $id; ?>">
				    <!-- Länk till produktsidan för att visa mer information och köpa produkten -->
				    <a href="produkt.php?productId=<?php echo $produkt['id']; ?>">
                        <button type="button">Läs mer och köp!</button>
                    </a>
                </form>
            </div>

            <?php
        }
    }
?>
    </div>
</main>
</body>
</html>
