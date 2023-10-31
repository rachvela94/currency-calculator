<?php
class CurrencyController extends CI_Controller {
    public function getCurrencyData() {
		$this->load->driver('cache', array('adapter' => 'file'));
		$this->config->load('config');

		header('Content-Type: application/json');

		$currency = $_GET['currency'];
		$data = $this->cache->get($currency);

		if(!$data) {
			$apiKey = $this->config->item('exchangerate_api_key');

			$url = "https://v6.exchangerate-api.com/v6/{$apiKey}/latest/{$currency}";
			$data = file_get_contents($url);
			$this->cache->save($currency, $data, 60 * 60 * 24); // Cache data for 24 hour
		}

		echo $data;
	}
}

