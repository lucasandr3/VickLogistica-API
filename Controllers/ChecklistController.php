<?php
namespace Controllers;

use \Core\Controller;
use \Models\Checklist;

class ChecklistController extends Controller {

    public function index()
    {
        $dados = $this->getRequestData();
        $ch = new Checklist();
        if (isset($dados['data']) && !empty($dados['data'])) {
            
            $check  = $dados['data']->check;
            $hora  = $dados['data']->hora;
            
            if($ch->saveCheck($check, $hora) == true) {

                $resposta['code'] = 0;
                $resposta['message'] = 'sucesso.';
                echo json_encode($resposta);
                exit;

            } else {

                $resposta['code'] = 1;
                $resposta['error'] = 'Nè´™o foi possivel agora, ficara pendente.';
                echo json_encode($resposta);
                exit;
            }
        }
    }

    public function manutencao()
    {
        $data = $this->getRequestData();
        $check = new Checklist();
        if (isset($data['data']) && !empty($data['data'])) {
            
            $datam  = $data['data'];

            if($check->saveManutencao($datam) == true) {

                $resposta['code'] = 0;
                $resposta['message'] = 'sucesso.';
                echo json_encode($resposta);
                exit;

            } else {

                $resposta['code'] = 1;
                $resposta['error'] = 'Nè´™o foi possivel agora, ficara pendente.';
                echo json_encode($resposta);
                exit;
            }
        }
    }
}