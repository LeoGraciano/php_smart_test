<?php

namespace SmartSolucoes\Controller;

use SmartSolucoes\Model\Calendario;
use SmartSolucoes\Libs\Helper;

class CalendarioController
{

	private $table = 'calendario';
    private $baseView = 'admin/calendario';
    private $urlIndex = 'calendario';

    public function index()
    {
        $model = New Calendario();
        $response = $model->all('calendario', 'id DESC');
        Helper::view($this->baseView.'/index',$response);
    }


    public function viewEdit($param)
    {
        $model = New Calendario();
        $response = $model->find($this->table,$param['id']);
        Helper::view($this->baseView.'/edit',$response);
    }

    public function create()
    {
        $model = New Calendario();
        if ($_POST['titulo']){
            if ($_POST['status'] == "on") {
                $_POST['status'] = 1 ;
            } else { 
                $_POST['status'] = 0;
            }

            $model->create($this->table,$_POST, []);
        }
        header('location: ' . URL_ADMIN . '/' . $this->urlIndex);
    }


    public function update()
    {
        $model = New Calendario();
        if(@$_SESSION['acesso'] == 'Administrador') $_POST['id_update_user'] = $_SESSION['id_user'];
        if($model->save($this->table,$_POST,['image'])) {
            header('location: ' . URL_ADMIN . '/' . $this->urlIndex);
        } else {
            Helper::view($this->baseView.'/edit/'.$_POST['id']);
        }
    }

    

}

