<?php
namespace Controllers;

use \Core\Controller;
use \Models\Front;

class FrontsController extends Controller {

    public function index()
    {
        $front = new Front();
        $fronts = $front->all();
        $this->returnJson($fronts);
    }

    public function changes()
    {
        $data = $this->getRequestData();
        $fr = new Front();
        if (isset($data['new_front']) && !empty($data['new_front'])) {
            
            $front = $data['new_front']->front;
            $id = $data['new_front']->id_travel;

            if(!$fr->canChange($id)) {
               if($fr->changeFront($front, $id) == true) {

                $resposta['code'] = 0;
                $resposta['message'] = 'sucesso.';
                echo json_encode($resposta);
                exit;

                } else {
    
                    $resposta['code'] = 1;
                    $resposta['error'] = 'N«ªo foi possivel agora, ficara pendente.';
                    echo json_encode($resposta);
                    exit;
                } 
            } else {
                $resposta['code'] = 2;
                $resposta['error'] = 'Voc«´ n«ªo pode trocar a frente.';
                echo json_encode($resposta);
                exit;
            }
        }
    }
}