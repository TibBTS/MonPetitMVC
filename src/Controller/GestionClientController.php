<?php
declare(strict_types=1);
namespace App\Controller;
use App\Model\GestionClientModel;
use ReflectionClass;
use App\Exceptions\AppException;
use Tools\MyTwig;

class GestionClientController {
    public function chercheUn(array $params) {
        $model = new GestionClientModel();
        $id = filter_var($params['id'], FILTER_VALIDATE_INT);
        $unClient = $model->find($id);
        if ($unClient) {
            $r = new ReflectionClass($this);
            //include_once PATH_VIEW . str_replace('Controller','View', $r->getShortName()). '/unClient.php';
            $vue = str_replace('Controller','View', $r->getShortName()). '/unClient.html.twig';
            MyTwig::afficheVue($vue ,array('unClient' => $unClient));
        } else {
            throw new AppException("Client" . $id . "inconnu");
        }
    }
    public function chercheTous(){
        $model = new GestionClientModel();
        $clients = $model->findAll();
        if ($clients) {
            $r = new ReflectionClass($this);
            //include_once PATH_VIEW . str_replace('Controller','View', $r->getShortName()). '/plusieursClients.php';
            $vue = str_replace('Controller','View', $r->getShortName()). '/plusieursClients.html.twig';
            MyTwig::afficheVue($vue ,array('Clients' => $clients));
        } else {
            throw new AppException("Aucun client à afficher");
        }
    }
    
    public function creerClient(array $params){
       $vue = "GestionClientView\\creerClient.html.twig";
       MyTwig::afficheVue($vue,array());
    }
    
    public 
    
}