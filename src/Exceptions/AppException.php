<?php

namespace App\Exceptions;

use Exception;

/**
* Classe d'exception spécifique à l'application
* @author Benoit ROCHE
*/

class AppException extends Exception {

// nom de l'utilisateur de l'aplication 
    const NOMUSERCONNECTE = APP_USER; 
// nom de l'application const 
    const NOMAPPLICATION = APP_NAME;

    public function _construct(string $message) {
            parent::__construct ("Erreur d'application". self:: NOMAPPLICATION . "<br> user :".
                self:: NOMUSERCONNECTE . "<br> message :". $message);
    }

}