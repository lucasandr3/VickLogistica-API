<?php
namespace Controllers;

use \Core\Controller;
use \Models\Driver;

class DriversController extends Controller {

	public function index()
	{
		$driver = new Driver();
		$resposta = $driver->all();
		$this->returnJson($resposta);
	}

	public function driverOne()
	{
		$this->returnJson(
			[
				"nome" => "Lucas Vieira",
				"Idade" => "90",
				"Cidade" => "Araguari"
			]
		);
	}

}