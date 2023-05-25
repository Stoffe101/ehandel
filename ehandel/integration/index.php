<?php

// Inkludera filen "Payment.php" som innehåller Payment-klassen
require 'Payment.php';

// Skapa en associativ array med statisk postdata för att skicka till Payment API:et
$postData = array(
	"customer" => array(
		"first_name" => "John",
		"last_name" => "Doe",
		"email" => "john@doe.com",
		"street" => "Main Street 3",
		"city" => "New York",
		"zip" => "34255",
		"country" => "USA"
	),
	"card" => array(
		"number" => "5555555555555555",
		"expiry_month" => "01",
		"expiry_day" => "25",
		"cvv" => "149"
	)
);

// Kontrollera om alla nödvändiga postdata-värden är satta från formuläret
if (
	isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) &&
	isset($_POST['street']) && isset($_POST['city']) && isset($_POST['zip']) &&
	isset($_POST['cardnumber']) && isset($_POST['expiry_month']) && isset($_POST['cvv']) &&
	isset($_POST['expiry_day']) && isset($_POST['country'])
) {
	// Hämta postdata-värden från formuläret
	$firstName = $_POST['first_name'];
	$lastName = $_POST['last_name'];
	$email = $_POST['email'];
	$street = $_POST['street'];
	$city = $_POST['city'];
	$zip = $_POST['zip'];
	$country = $_POST['country'];

	$number = $_POST['cardnumber'];
	$expiry_day = $_POST['expiry_day'];
	$expiry_month = $_POST['expiry_month'];
	$cvv = $_POST['cvv'];

	// Skapa en associativ array med postdata baserat på formulärdata
	$body = array(
		"customer" => array(
			"first_name" => $firstName,
			"last_name" => $lastName,
			"email" => $email,
			"street" => $street,
			"city" => $city,
			"zip" => $zip,
			"country" => $country
		),
		"card" => array(
			"number" => $number,
			"expiry_month" => $expiry_month,
			"expiry_day" => $expiry_day,
			"cvv" => $cvv
		)
	);

	// Skicka betalningsbegäran med postdata till Payment API:et och få svar
	$response = Payment::sendPayment($body);

	// Skriv ut svaret från API:et
	print_r($response);

	// Skicka en statisk betalningsbegäran med statisk postdata och få svar
	$response = Payment::sendPayment($postData);

	// Kontrollera om svaret innehåller ett meddelande
	if (isset($response['message'])) {
		print_r($response['message']);
	}
	// Kontrollera om svaret innehåller ett felmeddelande
	else if (isset($response['error'])) {
		print_r($response['error']);
	}
}
?>
