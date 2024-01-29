<?php

class PropiedadesController extends ScaffoldController
{
    public $model = 'propiedades';
    public $scaffild = 'kumbia';

    public function index($page = 1)
    {
        $this->data = (new $this->model())->paginate("page: $page", "order: Nombre desc");
    }
}
