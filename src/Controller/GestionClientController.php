<?php
declare(strict_types=1);
namespace App\Controller;
use App\Model\GestionClientModel;
use ReflectionClass;
use App\Exceptions\AppException;

class GestionClientController {
    public function chercheUn(array $params) {
        $model = new GestionClientModel();
        $id = filter_var($params['id'], FILTER_VALIDATE_INT);
        $unClient = $model->find($id);
        if ($unClient) {
            $r = new ReflectionClass($this);
            include_once PATH_VIEW . str_replace('Controller','View', $r->getShortName()). '/unClient.php';
        } else {
            throw new AppException("Client" . $id . "inconnu");
        }
    }
    public function chercheTous(){
        $model = new GestionClientModel();
        $clients = $model->findAll();
        if ($clients) {
            $r = new ReflectionClass($this);
            include_once PATH_VIEW . str_replace('Controller','View', $r->getShortName()). '/plusieursClients.php';
        } else {
            throw new AppException("Aucun client à afficher");
        }
        
    }
}