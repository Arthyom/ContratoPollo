<?php

class Arrendatarios extends ActiveRecord
{
    public function initialize()
    {
        //this->belongs_to('TargetModelName');
        $this->belongs_to('Propiedades');
        $this->has_many('Recibo');
        //this->has_and_belongs_to_many('TargetModelName');
    }
}
