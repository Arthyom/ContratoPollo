<?php

class DesalojosController extends AppController
{
    public function index()
    {
        View::select(null);
        View::template(null);

        $s = new Desalojos();

        echo var_dump($s);
        echo var_dump($s->Arrendatarios);




    }
}
