<?php
namespace Models;

use \Core\Model;

class Driver extends Model {

	public function all()
	{
		$sql = "SELECT * FROM drivers";
		$sql = $this->db->query($sql);
		return $resposta = $sql->fetchAll(\PDO::FETCH_ASSOC);
	}

}