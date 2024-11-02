<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crupier extends Model {
   private $manoCrupier = [];
   private $puntosCrupier = 0;

   /**
    * Get the value of manoCrupier
    */ 
   public function getManoCrupier()
   {
      return $this->manoCrupier;
   }

   /**
    * Set the value of manoCrupier
    *
    * @return  self
    */ 
   public function setManoCrupier($manoCrupier)
   {
      $this->manoCrupier = $manoCrupier;

      return $this;
   }

   /**
    * Get the value of puntosCrupier
    */ 
   public function getPuntosCrupier()
   {
      return $this->puntosCrupier;
   }

   /**
    * Set the value of puntosCrupier
    *
    * @return  self
    */ 
   public function setPuntosCrupier($puntosCrupier)
   {
      $this->puntosCrupier = $puntosCrupier;

      return $this;
   }
}
