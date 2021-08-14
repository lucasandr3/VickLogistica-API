<?php
namespace Models;

use \Core\Model;

class Front extends Model {

    public function all()
    {
        $sql ="SELECT * FROM fronts";
        $sql = $this->db->query($sql);
        return $fronts = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function canChange($id)
    {
        $sql ="SELECT * FROM front_arrival WHERE id_travel_ar = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
        
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function changeFront($front, $id)
    {
        $sql ="UPDATE control_init SET front_init = :fi WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':fi', $front);
        $sql->bindValue(':id', $id);
        $sql->execute();
        
        if ($sql->rowCount() > 0) {
            $sql ="UPDATE steps_travel SET frente = :frente WHERE id_travel_step = :idt";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':frente', $front);
            $sql->bindValue(':idt', $id);
            $sql->execute();
            return true;
        } else {
            return false;
        }
    }
}