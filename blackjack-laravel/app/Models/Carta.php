<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carta extends Model {
    private $palos = ["corazón", "diamante", "trebol", "pica"];
    private $numeroCarta = [];

    public function numeroCartas() {

        for($i=1; $i <= 13; $i++){
            switch ($i) {
                case 1:
                    array_push($this->numeroCarta, "A");
                    break;
                case 11:
                    array_push($this->numeroCarta, "J");
                    break;
                case 12:
                    array_push($this->numeroCarta, "Q");
                    break;
                case 13:
                    array_push($this->numeroCarta, "K");
                    break;
                default:
                    array_push($this->numeroCarta, $i);
                    break;
            }
        }
    }

    /**
     * Get the value of palos
     */ 
    public function getPalos()
    {
        return $this->palos;
    }

    /**
     * Get the value of numeroCarta
     */ 
    public function getNumeroCarta()
    {
        return $this->numeroCarta;
    }
}
