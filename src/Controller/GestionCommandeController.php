<?php
declare (strict_types=1);

namespace App\Controller;
use App\Model\GestionCommandeModel;
use ReflectionClass;
use App\Exceptions\AppException;

/**
 * Description of GestionClientController
 *
 * @author florian.gertner
 */
class GestionCommandeController {
    public function chercheUne(array $params) {
        // appel de la méthode find($id) de la classe Model adequate
        $modele = new GestionCommandeModel();
        $id = filter_var(intval($params["id"]), FILTER_VALIDATE_INT);
        $uneCommande = $modele->find($id);
        if ($uneCommande) {
            $r = new ReflectionClass($this);
            include_once PATH_VIEW . str_replace('Controller', 'View', $r->getShortName()) . "/uneCommande.php";
        } else {
            throw new AppException("Commande " . $id . " inconnu");
        }
    }
    
    public function chercheToutes() {
        // appel de la méthode findAll() de la classe Model adequate
        $modele = new GestionCommandeModel();
        $commandes = $modele->findAll();
        if ($commandes) {
            $r = new ReflectionClass($this);
            include_once PATH_VIEW . str_replace('Controller', 'View', $r->getShortName() . "/plusieursCommandes.php");
        } else {
            throw new AppException("Aucune commande à afficher");
        }
    }
}