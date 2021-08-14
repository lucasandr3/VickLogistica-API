<?php
namespace Models;

use \Core\Model;

class Auth extends Model {

    public function driverExists($record)
    {
        $sql ="SELECT * FROM drivers WHERE code_driver = :cd";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':cd', $record);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $_SESSION['driver'] = $sql->fetch(\PDO::FETCH_ASSOC);
            return true;
        } else {
            return false;
        }
        
    }

    public function validateUserMan($email_user, $senha)
    {
        $sql ="SELECT * FROM usuarios WHERE email_user = :email_user";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":email_user", $email_user);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$info = $sql->fetch(\PDO::FETCH_ASSOC);
        
			if (password_verify($senha, $info['senha'])) {
				$_SESSION['user_man'] = $info;
				$_SESSION['user_man']['token'] = md5(rand(0,999).'vick-logistica');
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		}
    }

    // public function getAllOptionsProduct($id_product)
    // {
    //     $sql ="SELECT GROUP_CONCAT(DISTINCT co.category_name_option SEPARATOR ';') AS categorias, GROUP_CONCAT(DISTINCT po.name_option SEPARATOR ';') AS opcoes, GROUP_CONCAT(DISTINCT po.price_option SEPARATOR ';') AS preco FROM category_option AS co INNER JOIN product_options AS po ON (co.id_category_option = po.id_category_option) WHERE id_product = :id GROUP BY co.category_name_option";
    //     $sql = $this->db->prepare($sql);
    //     $sql->bindValue(':id', $id_product);
    //     $sql->execute();
    //     $options = $sql->fetchAll(\PDO::FETCH_ASSOC);
        
    //     return $options;
    // }

    // public function getAllOptionsProduct($id_product)
    // {
    //     $sql ="SELECT c.category_name_option, GROUP_CONCAT(DISTINCT o.name_option SEPARATOR ";") as valores, GROUP_CONCAT(DISTINCT o.price_option SEPARATOR ";") as preco FROM category_option AS c LEFT JOIN product_options AS o ON o.id_category_option = c.id_category_option WHERE c.id_product = :id GROUP BY c.category_name_option";
    //     $sql = $this->db->prepare($sql);
    //     $sql->bindValue(':id', $id_product);
    //     $sql->execute();
    //     $options = $sql->fetchAll(\PDO::FETCH_ASSOC);
        
    //     return $options;
    // }

    public function getAllOptionsProduct($id_product)
    {
        $sql ="SELECT
        c.id_category_option,
        c.category_name_option,
        o.id_option,
        o.id_product,
        o.name_option,
        o.price_option
    FROM
        category_option AS c
    LEFT JOIN product_options AS o ON o.id_category_option = c.id_category_option
    WHERE
        c.id_product = :id AND c.active = 0
    GROUP BY
        c.id_category_option,
        c.category_name_option,
        o.id_option,
        o.id_product,
        o.name_option,
        o.price_option";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id_product);
        $sql->execute();
        $dados = $sql->fetchAll(\PDO::FETCH_ASSOC); 
        
        $options = [];
        $currentId = 0;
        $prevId = 0;
        $counter = 0;

        // monta o cabeçalho
        foreach ($dados as $key => $value) {
           
            $currentId = $value['id_category_option'];

            if ($currentId !== $prevId) {
                $options[$counter]['id_category_option'] = $value['id_category_option'];
                $options[$counter]['category_name_option'] = $value['category_name_option'];
                $counter++;
            }

            $prevId = $value['id_category_option'];

        }

        // monta os options
        foreach ($dados as $key => $value) {
            
            foreach ($options as $k => $v) {
                if ($value['id_category_option'] === $v['id_category_option']) {
                    $options[$k]['options'][] = $value['name_option'];
                    $options[$k]['price'][] = $value['price_option'];
                    $options[$k]['id_option'][] = $value['id_option'];
                }
            }
        }

        return $options;
        
    }


    public function getAlloptionsCategory()
    {
        $sql ="SELECT * FROM product_options";
        $sql = $this->db->query($sql);
        //$sql->bindValue(':id', $id_product);
        //$sql->execute();
        return $nameOpt = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }
}