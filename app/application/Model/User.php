<?php

namespace SmartSolucoes\Model;

use SmartSolucoes\Core\Model;
use SmartSolucoes\Libs\Helper;

class User extends Model
{

    public function allUsers()
    {
        $where = '';
        if(@$_SESSION['acesso'] == 'Empresa') {
            $where = " AND u.id_loja = '" . $_SESSION['id_loja'] . "'";
        }
        $sql = "
          SELECT u.*, l.nome loja,
            (SELECT GROUP_CONCAT(p.nome SEPARATOR ', ') FROM permissao p INNER JOIN user_permissao up ON up.id_permissao = p.id WHERE up.id_user = u.id GROUP BY up.id_user) permissoes
          FROM user u 
          LEFT JOIN loja l ON l.id = u.id_loja
          WHERE 1=1 $where
        ";
        $query = $this->PDO()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

}
