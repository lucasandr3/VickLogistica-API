<?php
namespace Models;

use \Core\Model;

class Checklist extends Model {

    public function saveCheck($check, $hora)
    {
        $sql ="INSERT INTO checklist SET checklist_json = :cj, date_final = :dt";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':cj', $check);
        $sql->bindValue(':dt', $hora);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function saveManutencao($datam)
    {
        
        $sql ="INSERT INTO manutencao SET manutencao_json = :mj";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':mj', $datam);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}