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
	<div class="search-container">
		<div>
			<input type="text" class="input-field" placeholder="Sök efter produkter...">
			<button class="input-button" style="height: 100%;">Sök</button>
		</div>
	</div>

	<h2 class="flex centered">Alla produkter</h2>
	<div class="featured">

	<?php
	// Inkluderar produktmodellen för att få tillgång till dess metoder
	require 'model/produktmodel.php';

	$produktmodel = new produktmodel();
	$produkter = $produktmodel->Getprodukt();

	$utvaldaCounter = 0;

	// Loopar genom varje produkt och visar dem som produktkort
	foreach ($produkter as $produkt) {
		if ($utvaldaCounter == 4) {
			break;
		}

		$utvaldaCounter++;
		?>

		<div class="product-card">
			<img src="bilder/<?php echo $produkt['img']; ?>">
			<h2><?php echo $produkt['namn']; ?></h2>
			<p><?php echo $produkt['description']; ?></p>
			<a href="produkt.php?productId=<?php echo $produkt['id']; ?>">
				<button>Läs mer och köp</button>
			</a>
		</div>

		<?php
	}
	?>

	</div>
</main>
</body>
</html>
