<?php

class PropiedadesController extends ScaffoldController
{
    public $model = 'propiedades';
    public $scaffild = 'kumbia';

    public function index($page = 1, $orderBy = '')
    {
        $this->data = (new $this->model())->paginate("page: $page", "order: Nombre asc", "per_page: 15");
    }
}
