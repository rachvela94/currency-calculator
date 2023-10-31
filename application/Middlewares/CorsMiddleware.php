<?php

class CorsMiddleware {
	public function handle() {
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, X-Requested-With");
		header("Access-Control-Max-Age: 3600");
	}
}
