<?php
namespace Models;

use \Core\Model;

class Waiting extends Model {
    
    public function start($id_patio, $driver, $frota, $hora_ini)
    {
        // echo "<pre>";
        // print_r($id_patio);
        // echo "<pre>";
        // print_r($driver);
        // echo "<pre>";
        // print_r($frota);
        // echo "<pre>";
        // print_r($hora_ini);
        // exit;
        $sql ="INSERT INTO waiting SET id = :id, driver = :d, fleet = :f, start = :st";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id_patio);
        $sql->bindValue(':d', $driver);
        $sql->bindValue(':f', $frota);
        $sql->bindValue(':st', $hora_ini);
        $sql->execute();
        
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function final($id_patio, $hora_final)
    {
        $sql ="UPDATE waiting SET final = :f WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':f', $hora_final);
        $sql->bindValue(':id', $id_patio);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}