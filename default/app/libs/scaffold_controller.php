<?php

/**
 * Controlador base para la construcción de CRUD para modelos rápidamente
 *
 * @category Kumbia
 * @package Controller
 */
abstract class ScaffoldController extends AdminController
{
    /** @var string Carpeta en views/_shared/scaffolds/ */
    public string $scaffold = 'kumbia';
    /** @var string Nombre del modelo en CamelCase */
    public $model = '';

    /**
     * Resultados paginados
     *
     * @param int $page  Página a mostrar
     */
    public function index($page = 1, $orderBy = 'Id')
    {
        $this->data = (new $this->model())->paginate("page: $page", "order: $orderBy desc");
    }

    /**
     * Crea un Registro
     */
    public function crear()
    {
        if (Input::hasPost($this->model)) {

            $obj = new $this->model();
            //En caso que falle la operación de guardar
            if (!$obj->save(Input::post($this->model))) {
                Flash::error('Falló Operación');
                //se hacen persistente los datos en el formulario
                $this->{$this->model} = $obj;
                return;
            }
            Redirect::to();
            return;
        }
        // Sólo es necesario para el autoForm
        $this->{$this->model} = new $this->model();
    }

    /**
     * Edita un Registro
     *
     * @param int $id  Idendificador del registro
     */
    public function editar($id)
    {
        View::select('crear');

        //se verifica si se ha enviado via POST los datos
        if (Input::hasPost($this->model)) {
            $obj = new $this->model();
            if (!$obj->update(Input::post($this->model))) {
                Flash::error('Falló Operación');
                //se hacen persistente los datos en el formulario
                $this->{$this->model} = Input::post($this->model);
            } else {
                Redirect::to();
                return;
            }
        }

        //Aplicando la autocarga de objeto, para comenzar la edición
        $this->{$this->model} = (new $this->model())->find((int) $id);
    }

    /**
     * Borra un Registro
     *
     * @param int $id Identificador de registro
     */
    public function borrar($id)
    {
        if (!(new $this->model())->delete((int) $id)) {
            Flash::error('Falló Operación');
        }
        //enrutando al index para listar los articulos
        Redirect::to();
    }

    /**
     * Ver un Registro
     *
     * @param int $id Identificador de registro
     */
    public function ver($id)
    {
        $this->data = (new $this->model())->find_first((int) $id);
    }
}
