<?php
// Hämta produkt-ID:na från kakan 'cart'
$productIds = $_COOKIE['cart'];

// Anslutning till databasen
$host = 'localhost';
$dbname = 'ehandel';
$username = 'root';
$password = '';
$conn = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);

// Hämta produkter baserat på produkt-ID:na
$sql = "SELECT * FROM produkter WHERE id IN ($productIds)";
$products = $conn->query($sql)->fetchAll();
?>
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
	<form action="/ehandel/integration/index.php" method="POST">
	<h2 class="flex centered">Din kundvagn</h2>

	<div class="two-columns">
		<div class="items-list">

			<?php foreach ($products as $product) : ?>
				<div>
					<h2><?= $product['namn']?></h2>
					<p><?= $product['pris'] . "kr"?></p>
					<img class="snus" src="bilder /<?php echo $product['img']; ?> ">
				</div>
			<?php endforeach; ?>

		</div>

		<div class="payment-info">

			<div class="payment-info-division">
				<div class="input-box">
					<label>Förnamn</label>
					<input type="text" name="first_name">
				</div>

				<div class="input-box">
					<label>Efternamn</label>
					<input type="text" name="last_name">
				</div>
			</div>

			<div class="input-box">
				<label>E-post</label>
				<input type="text" name="email">
			</div>

			<div class="input-box">
				<label>Gata</label>
				<input type="text" name="street">
			</div>

			<div class="input-box">
				<label>Stad</label>
				<input type="text" name="city">
			</div>
			
			<div class="input-box">
				<label>Land</label>
				<input type="text" name="country">
			</div>

			<div class="input-box">
				<label>Postkod</label>
				<input type="text" name="zip">
			</div>

			<div class="input-box">
				<label>Kortnummer</label>
				<input type="text" name="cardnumber">
			</div>

			<div class="input-box">
				<label>Datum</label>
				<input type="text" name="expiry_month">
			</div>

			<div class="input-box">
				<label>Datum</label>
				<input type="text" name="expiry_day">
			</div>

			<div class="input-box">
				<label>CVV</label>
				<input type="text" name="cvv">
			</div>
			
			<input class="input-button rounded" type="submit" value="Beställ">

		</div>
	</div>
</form>
</main>
</body>
</html>
