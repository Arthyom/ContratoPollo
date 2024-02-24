<?php

class Desalojos extends ActiveRecord
{
    public function initialize()
    {
        $this->belongs_to('Propiedades');
        $this->belongs_to('Arrendatorios');

        //this->has_many('TargetModelName');
        //this->has_and_belongs_to_many('TargetModelName');
    }
}
