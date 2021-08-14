<?php
namespace Models;

use \Core\Model;

class Travel extends Model {

    public function saveControlInit($id_travel, $fleet, $front, $km, $rebsr, $rebrb, $hora, $driver)
    {
        $sql ="INSERT INTO control_init SET id = :id, fleet = :fl, front_init = :fi, driver = :driver, km_init = :ki, fleet_sr = :fs, fleet_rb = :fr, date_init = :di";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id_travel);
        $sql->bindValue(':fl', $fleet);
        $sql->bindValue(':fi', $front);
        $sql->bindValue(':driver', $driver);
        $sql->bindValue(':ki', $km);
        $sql->bindValue(':fs', $rebsr);
        $sql->bindValue(':fr', $rebrb);
        $sql->bindValue(':di', $hora);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $ini = 'inicio'; 
            $sql ="INSERT INTO steps_travel SET id_travel_step = :its, driver = :driver, frente = :frente, fleet = :fleet, init = :ini, date_travel = NOW()";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':its', $id_travel);
            $sql->bindValue(':driver', $driver);
            $sql->bindValue(':frente', $front);
            $sql->bindValue(':fleet', $fleet);
            $sql->bindValue(':ini', $ini);
            $sql->execute();
            return true;
        } else {
            return false;
        }

        // $ini = 'inicio'; 
        // $sql ="INSERT INTO steps_travel SET id_travel_step = :its, fleet = :fleet, init = :ini, date_travel = NOW()";
        // $sql = $this->db->prepare($sql);
        // $sql->bindValue(':its', $id_travel);
        // $sql->bindValue(':fleet', $fleet);
        // $sql->bindValue(':ini', $ini);
        // $sql->execute();
    }

    public function saveFrontArrival($id_travel, $km_chegada, $hora)
    {
        $sql ="INSERT INTO front_arrival SET id_travel_ar = :it, km_arrival = :ka, date_arrival = :da";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':it', $id_travel);
        $sql->bindValue(':ka', $km_chegada);
        $sql->bindValue(':da', $hora);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $ini = 'noaction';
            $arrival = 'arrival'; 
            $sql ="UPDATE steps_travel SET init = :ini, front_arrival = :far WHERE id_travel_step = :itp";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':ini', $ini);
            $sql->bindValue(':far', $arrival);
            $sql->bindValue(':itp', $id_travel);
            $sql->execute();
            return true;
        } else {
            return false;
        }

        
    }

    public function saveFrontExit($id_travel, $km_saidaFrente, $rebsr, $rebrb, $hora)
    {
        $sql ="INSERT INTO front_exit SET id_travel_ex = :it, km_exit = :ke, rebsr = :rs, rebrb = :rb, date_exit = :de";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':it', $id_travel);
        $sql->bindValue(':ke', $km_saidaFrente);
        $sql->bindValue(':rs', $rebsr);
        $sql->bindValue(':rb', $rebrb);
        $sql->bindValue(':de', $hora);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $ini = 'noaction';
            $arrival = 'noaction';
            $exit = 'exit'; 
            $sql ="UPDATE steps_travel SET init = :ini, front_arrival = :far, front_exit = :ex WHERE id_travel_step = :itp";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':ini', $ini);
            $sql->bindValue(':far', $arrival);
            $sql->bindValue(':ex', $exit);
            $sql->bindValue(':itp', $id_travel);
            $sql->execute();
            return true;
        } else {
            return false;
        }

        
    }

    public function saveBalanceArrival($id_travel, $km_balanca, $hora)
    {
        $sql ="INSERT INTO balance_arrival SET id_travel_bal = :it, km_bal_arrival = :kba, date_bal_arrival = :dba";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':it', $id_travel);
        $sql->bindValue(':kba', $km_balanca);
        $sql->bindValue(':dba', $hora);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $ini = 'noaction';
            $arrival = 'noaction';
            $exit = 'noaction';
            $bal = 'bal'; 
            $sql ="UPDATE steps_travel SET init = :ini, front_arrival = :far, front_exit = :ex, balance_arrival = :bal WHERE id_travel_step = :itp";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':ini', $ini);
            $sql->bindValue(':far', $arrival);
            $sql->bindValue(':ex', $exit);
            $sql->bindValue(':bal', $bal);
            $sql->bindValue(':itp', $id_travel);
            $sql->execute();
            return true;
        } else {
            return false;
        }

        
    }

    public function saveDischarge($id_travel, $discharge, $hora)
    {
        $sql ="INSERT INTO discharge SET id_travel_dis = :it, place = :p, date_discharge = :dd";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':it', $id_travel);
        $sql->bindValue(':p', $discharge);
        $sql->bindValue(':dd', $hora);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $ini = 'noaction';
            $arrival = 'noaction';
            $exit = 'noaction';
            $bal = 'noaction'; 
            $dis = 'dis'; 
            $sql ="UPDATE steps_travel SET init = :ini, front_arrival = :far, front_exit = :ex, balance_arrival = :bal, discharge = :dis WHERE id_travel_step = :itp";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':ini', $ini);
            $sql->bindValue(':far', $arrival);
            $sql->bindValue(':ex', $exit);
            $sql->bindValue(':bal', $bal);
            $sql->bindValue(':dis', $dis);
            $sql->bindValue(':itp', $id_travel);
            $sql->execute();
            return true;
        } else {
            return false;
        }

        
    }

    public function saveFinal($id_travel, $hora)
    {
        $sql ="INSERT INTO control_final SET id_travel_fi = :it, date_final = :df";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':it', $id_travel);
        $sql->bindValue(':df', $hora);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $ini = 'noaction';
            $arrival = 'noaction';
            $exit = 'noaction';
            $bal = 'noaction'; 
            $dis = 'noaction';
            $final = 'final';
            $finalized = 0; 
            $sql ="UPDATE steps_travel SET init = :ini, front_arrival = :far, front_exit = :ex, balance_arrival = :bal, discharge = :dis, final = :fin, finalized = :fnd WHERE id_travel_step = :itp";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':ini', $ini);
            $sql->bindValue(':far', $arrival);
            $sql->bindValue(':ex', $exit);
            $sql->bindValue(':bal', $bal);
            $sql->bindValue(':dis', $dis);
            $sql->bindValue(':fin', $final);
            $sql->bindValue(':fnd', $finalized);
            $sql->bindValue(':itp', $id_travel);
            $sql->execute();
            return true;
        } else {
            return false;
        }

        

    }

    public function changeDriver($driver, $change, $id)
    {
        $sql ="UPDATE steps_travel SET driver = :d, driver_old = :do WHERE id_travel_step = :idtstep";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':d', $driver);
        $sql->bindValue(':do', $change);
        $sql->bindValue(':idtstep', $id);
        $sql->execute();
        
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function verifyTravel($id)
    {
        $sql ="SELECT * FROM steps_travel WHERE id_travel_step = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
        
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}