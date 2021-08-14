<?php
namespace Controllers;

use \Core\Controller;
use \Models\Auth;

class AuthController extends Controller {

    public function signin()
    {
        $method = $this->getMethod();
        $data = $this->getRequestData();

        $auth = new Auth();
        if (isset($data['record']) && !empty($data['record'])) {
            
            // $name     = filter_input(INPUT_POST, trim('name'));
            // $frota    = filter_input(INPUT_POST, trim('frota'));
            // $record   = filter_input(INPUT_POST, trim('record'));
            // $password = filter_input(INPUT_POST, trim('password'));
            
            $record   = $data['record'];

            if ($auth->driverExists($record) === true) {
                $resposta['code'] = 0;
                $resposta['driver'] = $_SESSION['driver'];
                $this->returnJson($resposta);
                exit;
            } else {
                $resposta['code'] = 1;
                $resposta['error'] = 'Motorista não encontrado';
                $this->returnJson($resposta);
                exit;
            }
        } else {
            $resposta['code'] = 1;
            $resposta['error'] = 'Verifique sua conexão';
            $this->returnJson($resposta);
            exit;
        }
    }

    public function signin_manutencao()
    {
        $data = $this->getRequestData();
        if (!empty($data['user']) && !empty($data['user'])) {
            
            $email_user = $data['user']->email;
            $senha = $data['user']->senha;

            $uid = new Auth();

            if ($uid->validateUserMan($email_user, $senha) === true) {
                $resposta['code'] = 0;
                $resposta['user'] = $_SESSION['user_man'];
                $this->returnJson($resposta);
                exit;
            } else {
                $resposta['code'] = 1;
                $resposta['error'] = 'E-mail e/ou senha errados!';
                $this->returnJson($resposta);
                exit;
            }
        } else {
            $resposta['code'] = 2;
            $resposta['error'] = 'Verifique sua conexão';
            $this->returnJson($resposta);
            exit;
        }
    }

    public function options($id_product)
    {
        $product  = new Product();
        $options = $product->getAllOptionsProduct($id_product);
        //$products = 'id do produto: '. $id_product;
        $this->returnJson($options);
    }

    public function nameOpt()
    {
        $product  = new Product();
        $nameOpt = $product->getAlloptionsCategory();
        //$products = 'id do produto: '. $id_product;
        $this->returnJson($nameOpt);
    }
}