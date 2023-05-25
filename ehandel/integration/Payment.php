<?php

class Payment {
	public static function sendPayment($body) {
		$ch = curl_init('http://payment.avitusit.se/payments');

		curl_setopt_array($ch, array(
			CURLOPT_POST => TRUE,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			),
			CURLOPT_POSTFIELDS => json_encode($body)
		));

		$response = curl_exec($ch);

		if($response === FALSE){
			die(curl_error($ch));
		}

		return json_decode($response, TRUE);
	}
}
