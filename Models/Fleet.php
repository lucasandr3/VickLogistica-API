<?php
namespace Models;

use \Core\Model;

class Fleet extends Model {

    public function all()
    {
        $sql ="SELECT * FROM fleet";
        $sql = $this->db->query($sql);
        return $fleet = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function allReboques()
    {
        $sql ="SELECT * FROM equipaments";
        $sql = $this->db->query($sql);
        return $reboques = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function allSemiReboques()
    {
        $sql ="SELECT * FROM equipaments WHERE tipo = 'Semi Reboque'";
        $sql = $this->db->query($sql);
        return $reboques = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }
}