<?php
namespace Controllers;

use \Core\Controller;
use \Models\Data;

class DataController extends Controller {

    public function index()
    {
        $d = new Data();
        if($data = $d->getDataApp()) {
            $resposta['code'] = 0;
            $resposta['data'] = $data;
            returnJson($resposta);
        } else {
            $resposta['code'] = 1;
            $resposta['data'] = "Erro ao trazer dados, procure o suporte";
            returnJson($resposta);
        }
    }

    public function manutencao()
    {
        $check = new Checklist();
        if (isset($_POST['data']) && !empty($_POST['data'])) {
            
            $data  = filter_input(INPUT_POST, trim('data'));

            if($check->saveManutencao($data) == true) {

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
}