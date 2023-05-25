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
	<h2 class="flex centered">Alla kategorier</h2>
	<div class="featured">
		<?php
		// Inkludera kategorimodellen
		require 'model/kategorimodel.php';

		// Skapa en instans av kategorimodellen
		$categoryModel = new kategorimodel();

		// Hämta kategorier från kategorimodellen
		$categories = $categoryModel->Getkategori();

		// Loopa genom kategorierna och visa dem
		foreach ($categories as $cat) {
			// Spara kategorins id i variabeln $categoryid för att använda i kategori.php
			$categoryid = $cat['id'];
		?>

			<div class="featured-card">
				<h2><?php echo $cat['name'] ?></h2>
				<p><?php echo $cat['description'] ?></p>
				<form action="kategori.php" method="GET">
					<input type="hidden" name="categoryId" value="<?php echo $categoryid; ?>">
					<button type="submit">Se alla produkter</button>
				</form>
			</div>

		<?php } ?>

	</div>
</main>
</body>
</html>
