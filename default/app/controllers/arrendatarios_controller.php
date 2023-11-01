<?php

class ArrendatariosController extends ScaffoldController
{
    public $model = 'arrendatarios';

    /**
     * Resultados paginados
     *
     * @param int $page  Página a mostrar
     */
    public function index($page = 1)
    {
        $this->data = (new $this->model())->paginate("page: $page", 'order: id desc');
    }

}
