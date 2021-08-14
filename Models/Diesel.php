<?php
namespace Models;

use \Core\Model;

class Diesel extends Model {

    public function saveDiesel($fleet, $tankone, $tanktwo, $total, $hora)
    {
        $sql ="INSERT INTO diesel SET fleet = :f, tankone = :tko, tanktwo = :tkt, total = :t, date_diesel = :dd";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':f', $fleet);
        $sql->bindValue(':tko', $tankone);
        $sql->bindValue(':tkt', $tanktwo);
        $sql->bindValue(':t', $total);
        $sql->bindValue(':dd', $hora);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}