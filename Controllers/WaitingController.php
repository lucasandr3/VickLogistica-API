<?php
namespace Controllers;

use \Core\Controller;
use \Models\Waiting;

class WaitingController extends Controller {

    public function start()
    {
        $data = $this->getRequestData();
        // echo "<pre>";
        // print_r($data);
        // exit;
        $wai = new Waiting();
        if (isset($data['waiting_start']) && !empty($data['waiting_start'])) {

            $id_patio = $data['waiting_start']->id_patio;
            $driver   = $data['waiting_start']->driver;
            $frota    = $data['waiting_start']->frota;
            $hora_ini = $data['waiting_start']->hora_ini;

            if ($wai->start($id_patio, $driver, $frota, $hora_ini) == true) {
                
                $resposta['code'] = 0;
                $resposta['message'] = 'sucesso.';
                echo json_encode($resposta);
                exit;

            } else {
                
                $resposta['code'] = 1;
                $resposta['error'] = 'Não foi possivel agora, ficara pendente.';
                echo json_encode($resposta);
                exit;
            }
            
        } 
    }

    public function final()
    {
        $data = $this->getRequestData();
        $wai = new Waiting();
        if (isset($data['waiting_end']) && !empty($data['waiting_end'])) {

            $id_patio   = $data['waiting_end']->id_patio;
            $hora_final = $data['waiting_end']->hora_final;

            if ($wai->final($id_patio, $hora_final) == true) {
                
                $resposta['code'] = 0;
                $resposta['message'] = 'sucesso.';
                echo json_encode($resposta);
                exit;

            } else {

                $resposta['code'] = 1;
                $resposta['error'] = 'Não foi possivel agora, ficara pendente.';
                echo json_encode($resposta);
                exit;
            }
            
        } 
    }

    public function new()
    {
        echo "controler orders";
    }
}