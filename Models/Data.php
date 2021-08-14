<?php
namespace Models;

use \Core\Model;

use\Models\Fleet;

class Data extends Model {

    public function getDataApp()
    {
        $array = [];
        $sql ="SELECT * FROM fleet";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array['fleet'] = $sql->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($array as $key => $value) {
                $array['reboques'] = $this->allReboques();
                $array['semi_reboques'] = $this->allSemiReboques();
                $array['fronts'] = $this->allFronts();
                $array['drivers'] = $this->allDrivers();
            }

        } else {
            return false;
        }

        return $array;
    }

    public function allReboques()
    {
        $sql ="SELECT * FROM equipaments WHERE tipo = 'Reboque'";
        $sql = $this->db->query($sql);
        // echo "<pre>";
        // print_r($sql->fetchAll(\PDO::FETCH_ASSOC));
        // exit;
        return $reboques = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function allSemiReboques()
    {
        $sql ="SELECT * FROM equipaments WHERE tipo = 'Semi Reboque'";
        $sql = $this->db->query($sql);
        return $semireboques = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function allFronts()
    {
        $sql ="SELECT * FROM fronts";
        $sql = $this->db->query($sql);
        return $fronts = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function allDrivers()
	{
		$sql = "SELECT * FROM drivers";
		$sql = $this->db->query($sql);
		return $resposta = $sql->fetchAll(\PDO::FETCH_ASSOC);
	}

}