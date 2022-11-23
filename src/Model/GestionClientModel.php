<?php
declare (strict_types=1);
namespace App\Model;

use PDO;
use App\Entity\Client;
use Tools\Connexion;
use Exception;
use App\Exceptions\AppException;



class GestionClientModel {

    public function find (int $id): Client {
        try {
            $unObjetPdo = Connexion::getConnexion();
            $sql = "select * from CLIENT where id=:id";
            $ligne = $unObjetPdo->prepare($sql);
            $ligne->bindValue ('id', $id, PDO:: PARAM_INT);
            $ligne->execute();
            return $ligne->fetchObject (Client::class);
        } catch (Exception) {
            throw new AppException("Erreur technique inattendue");
        }

    }

    public function findAll(): array {
        $unObjetPdo= Connexion::getConnexion();
        $sql = 'select * from CLIENT';
        $lignes = $unObjetPdo->query($sql);
        return $lignes->fetchAll(PDO::FETCH_CLASS, Client:: class);
    }


    public function enregistreClient(Client $client) {
        try {
            $unObjetPdo = Connexion::getConnexion();
            $sql= "insert into client (titreCli, nomCli, prenomCli, adresseRuelCli, adresseRue2Cli, cpCli, villeCli, telCli)"
                    . "values (:titreCli, :nonCli, :prenonCli, :adresseRuelCli, :adresseRue2Cli, :cpCli, :villeCli, :telCli)";
            $s= $unObjetPdo->prepare($sql);
            $s->bindValue(":titreCli", $client->getTitreCli(), FDO::PARAM_STR);
            $s->bindValue(":nonCli", $client->getNomC1i(), PDO::PARAM_STR);
            $s->bindValue(':prenonCli', $client->getPrenomCli(), PDO::PARAM_STR);
            $s->bindValue(":adresseRuelCli", $client->getAdresseRue1Cli(), PDO::PARAM_STR);
            $s->bindValue(":adresseRue2Cli", ($client->getAdresseRue2Cli()=="") ? (null): ($client->getAdresseRue2Cli()), PDO::PARAM_STR);
            $s->bindValue(':cpCli', $client->getCpCli(), PDO::PARAM_STR);
            $s->bindValue(":villeCli'", $client->getVilleCli(), PDO::PARAM_STR);
            $s->bindValue(":telCli", $client->getTelCli(), PDO::PARAM_STR);
            $s->execute();
        }catch (PDOException) {
            throw new AppException("Erreur technique inattendue");

        }
    }
    
    public function findIds () {
        try {
        $unobjetPdo=Connexion::getConnexion();
        $sql = "select id from CLIENT";
        $lignes = $unobjetPdo->query($sql);
        // on va configurer le mode objet pour la lisibilité du code 
        if ($lignes->rowCount() > 0) {
            //$lignes->setFetchMode();
            $t = $lignes->fetchAll (PDO::FETCH_ASSOC);
            return $t;
        } else {
            throw new AppException ('Aucun client trouvé');
        }
        } catch (PDOException) {
            throw new AppException ("Erreur technique inattendue");
        }
        
    }



}

