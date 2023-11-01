<?php
    
    class Propiedades extends ActiveRecord{	
    
         public function initialize(){
             $this->has_one('Arrendatarios');
             //this->has_one('TargetModelName');
             //this->has_many('TargetModelName');
             //this->has_and_belongs_to_many('TargetModelName');
         }
    }