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
    // Kontrollera om ett productId finns i GET-variabeln
    if (isset($_GET['productId'])) {
        $id = $_GET['productId'];

        // Inkludera produktmodellen och kategorimodellen
        require 'model/produktmodel.php';
        require 'model/kategorimodel.php';

        // Skapa en instans av produktmodellen och hämta produkten med det givna id:et
        $produktmodel = new produktmodel();
        $produkt = $produktmodel->getProductById($id);

        // Kontrollera om produkten hittades
        if ($produkt) {
            $namn = $produkt['namn'];
            $beskrivning = $produkt['description'];
            $pris = $produkt['pris'];
            $bild = $produkt['img'];
            $kategorinamn = $produkt['kategori'];

            // Skapa en instans av kategorimodellen och hämta kategorins id baserat på namnet
            $kategorimodel = new kategorimodel();
            $kategoriId = $kategorimodel->getCategoryIdByName($kategorinamn);
            ?>

            <div class="two-columns">
                <div class="product-information">
                    <h2><?php echo $namn; ?></h2>
                    <p><?php echo $beskrivning; ?></p>
                    <img src="bilder/<?php echo $bild; ?>">
                </div>

                <?php
                // Kontrollera om en postförfrågan skickas med addProductId
                if (isset($_POST['addProductId'])) {
                    // Kontrollera om kundvagnscookien redan finns
                    if (isset($_COOKIE['cart'])) {
                        // Lägg till det nya produktdet i kundvagnscookien
                        setcookie('cart', $_COOKIE['cart'] . ',' . $_POST['addProductId'], time() + 3600);
                    } else {
                        // Skapa en ny kundvagnscookie och lägg till produktdet i den
                        setcookie('cart', $_POST['addProductId'], time() + 3600);
                    }
                }
                ?>

                <div class="product-buy-information">
                    <h2><?php echo $pris; ?>kr</h2>
                    <form method="post">
                        <input type='hidden' name='addProductId' value='<?php echo $id; ?>'>
                        <button class="input-button rounded">Lägg i varukorg</button>
                    </form>

                    <br>
                    <br>
                    <br>
                    <br>

                    <form action="kategori.php" method="GET">
                        <input type="hidden" name="categoryId" value="<?php echo $kategoriId; ?>">
                        <button class="input-button rounded">Visa fler produkter i kategorin</button>
                    </form>
                </div>
            </div>

            <?php
        } else {
            echo "Produkten hittades inte.";
        }
    } else {
        echo "Ingen produkt vald.";
    }
    ?>
</main>
</body>
</html>
