<?php
namespace Controllers;

use \Core\Controller;
use \Models\Diesel;

class DieselController extends Controller {

    public function index()
    {
        $data = $this->getRequestData();
        $diesel = new Diesel();
        if (isset($data['abastecimento']->fleet) && !empty($data['abastecimento']->fleet)) {
            
            $fleet   = $data['abastecimento']->fleet;
            $tankone = $data['abastecimento']->tkOne;
            $tanktwo = $data['abastecimento']->tkTwo;
            $total   = $data['abastecimento']->total;
            $hora    = $data['abastecimento']->hora;
            
            if($diesel->saveDiesel($fleet, $tankone, $tanktwo, $total, $hora) == true) {

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