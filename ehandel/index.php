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
	<!-- Sökfält -->
	<div class="search-container">
		<div>
			<input type="text" class="input-field" placeholder="Sök efter produkter...">
			<button class="input-button" style="height: 100%;">Sök</button>
		</div>
	</div>

	<h2 class="flex centered">Utvalda produkter</h2>

	<div class="featured">
		<?php
		// Inkludera produktmodellen
		require 'model/produktmodel.php';

		// Skapa en instans av produktmodellen
		$produktmodel = new produktmodel();

		// Hämta produkter från produktmodellen
		$produkter = $produktmodel->Getprodukt();

		$utvaldaCounter = 0;

		// Loopa genom produkterna och visa utvalda produkter
		foreach ($produkter as $produkt) {
			if ($utvaldaCounter == 4) {
				break;
			}

			$utvaldaCounter++;
		?>

			<div class="product-card">
				<img src="bilder/<?php echo $produkt['img']; ?>">
				<h2><?php echo $produkt['namn'] ?></h2>
				<p><?php echo $produkt['description'] ?></p>
				<a href="produkt.php?productId=<?php echo $produkt['id']; ?>">
					<button>Läs mer och köp</button>
				</a>
			</div>

		<?php } ?>
	</div>

	<h2 class="flex centered">Utvalda Kategorier</h2>

	<div class="featured">
		<?php
		// Inkludera kategorimodellen
		require 'model/kategorimodel.php';

		// Skapa en instans av kategorimodellen
		$kategorimodel = new kategorimodel();

		// Hämta kategorier från kategorimodellen
		$kategorier = $kategorimodel->Getkategori();

		$utvaldaCounter = 0;

		// Loopa genom kategorierna och visa utvalda kategorier
		foreach ($kategorier as $kategori) {
			if ($utvaldaCounter == 4) {
				break;
			}

			$utvaldaCounter++;
		?>

			<div class="featured-card">
				<h2><?php echo $kategori['name'] ?></h2>
				<p><?php echo $kategori['description'] ?></p>
				<form action="kategori.php" method="GET">
					<input type="hidden" name="categoryId" value="<?php echo $kategori['id']; ?>">
					<button type="submit">Se alla produkter</button>
				</form>
			</div>

		<?php } ?>
	</div>
</main>
</body>
</html>
