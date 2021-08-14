<?php
namespace Controllers;

use \Core\Controller;
use \Models\Travel;

class TravelController extends Controller {

    public function index()
    {
        $data = $this->getRequestData();
        $travel = new Travel();
        if (isset($data['step_one']) && !empty($data['step_one'])) {
            
            $id_travel = $data['step_one']->id_travel;
            $fleet     = $data['step_one']->fleet;
            $front     = $data['step_one']->frente;
            $km        = $data['step_one']->km_ini;
            $rebsr     = $data['step_one']->semi_reboque;
            $rebrb     = $data['step_one']->reboque;
            $hora      = $data['step_one']->hora;
            $driver    = $data['step_one']->driver;
            

            if($travel->saveControlInit($id_travel, $fleet, $front, $km, $rebsr, $rebrb, $hora, $driver)) {

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

    public function front_arrival()
    {
        $data = $this->getRequestData();
        $travel = new Travel();
        if (isset($data['step_two']) && !empty($data['step_two'])) {
            
            $id_travel  = $data['step_two']->id_travel;
            $km_chegada = $data['step_two']->km_chegada;
            $hora       = $data['step_two']->hora;
   
            if($travel->saveFrontArrival($id_travel, $km_chegada, $hora)) {

                $resposta['code'] = 0;
                $resposta['message'] = 'sucesso.';
                echo json_encode($resposta);
                exit;

            } else {

                $resposta['code'] = 1;
                $resposta['error'] = 'Erro ao enviar dados, tente novamente.';
                echo json_encode($resposta);
                exit;
            }
        }
    }

    public function front_exit()
    {
        $data = $this->getRequestData();
        $travel = new Travel();
        if (isset($data['step_three']) && !empty($data['step_three'])) {
            
            $id_travel      = $data['step_three']->id_travel;
            $km_saidaFrente = $data['step_three']->km_saida;
            $rebsr          = $data['step_three']->semi_reboque;
            $rebrb          = $data['step_three']->reboque;
            $hora           = $data['step_three']->hora;

            if($travel->saveFrontExit($id_travel, $km_saidaFrente, $rebsr, $rebrb, $hora) == true) {

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

    public function balance_arrival()
    {
        $data = $this->getRequestData();
       
        $travel = new Travel();
        if (isset($data['step_for']) && !empty($data['step_for'])) {
            
            $id_travel  = $data['step_for']->id_travel;
            $km_balanca = $data['step_for']->km_balanca;
            $hora       = $data['step_for']->hora;

            if($travel->saveBalanceArrival($id_travel, $km_balanca, $hora) == true) {

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

    public function discharge()
    {
        $data = $this->getRequestData();
        $travel = new Travel();
        if (isset($data['step_five']) && !empty($data['step_five'])) {
            
            $id_travel  = $data['step_five']->id_travel;
            $discharge  = $data['step_five']->entrada_usina;
            $hora       = $data['step_five']->hora;

            if($travel->saveDischarge($id_travel, $discharge, $hora) == true) {

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

    public function control_final()
    {
        $data = $this->getRequestData();
        $travel = new Travel();
        if (isset($data['step_final']) && !empty($data['step_final'])) {
            
            $id_travel  = $data['step_final']->id_travel;
            $hora       = $data['step_final']->hora;

            if($travel->saveFinal($id_travel, $hora) == true) {

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

    public function change_driver()
    {
        $data = $this->getRequestData();

        $travel = new Travel();
        if (isset($data['new_driver']) && !empty($data['new_driver'])) {
            
            $driver = $data['new_driver']->driver;
            $change = $data['new_driver']->change;
            $id = $data['new_driver']->id_travel;
            
            if($travel->verifyTravel($id) === true) {
               
                if($travel->changeDriver($driver, $change, $id) == true) {
    
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
            } else {
                $resposta['code'] = 2;
                $resposta['error'] = 'Para fazer a troca é precisar iniciar uma viagem.';
                echo json_encode($resposta);
                exit;
            }
        }
    }
}