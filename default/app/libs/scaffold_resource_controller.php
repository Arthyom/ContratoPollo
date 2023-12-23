<?php

/**
 * Controlador para manejar peticiones REST
 *
 * Por defecto cada acción se llama como el método usado por el cliente
 * (GET, POST, PUT, DELETE, OPTIONS, HEADERS, PURGE...)
 * ademas se puede añadir mas acciones colocando delante el nombre del método
 * seguido del nombre de la acción put_cancel, post_reset...
 *
 * @category Kumbia
 * @package Controller
 * @author kumbiaPHP Team
 */
abstract class ScaffoldResourceController extends RestController
{
    /** @var string Carpeta en views/_shared/scaffolds/ */
    public string $scaffold = 'kumbia';
    /** @var  Nombre del modelo en CamelCase */
    public $model = '';

    /**
     * Resultados paginados
     *
     * @param int $page  Página a mostrar
     */
    public function getAll($page = 1)
    {
        $this->data = (new $this->model())->paginate("page: $page", 'order: id desc');
    }

    /**
     * Crea un Registro
     */
    public function post()
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
    public function patch($id)
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
    public function delete($id)
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
    public function get($id)
    {
        $this->data = (new $this->model())->find_first((int) $id);
    }
}
