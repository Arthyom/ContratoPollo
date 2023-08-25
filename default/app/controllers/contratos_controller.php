<?php



/**
 * Controller por defecto si no se usa el routes
 *
 */
class ContratosController extends AppController
{
    public function index()
    {
    }


    public function crearContrato()
    {

        View::select(null);
        View::template('json');


        $paths = (new Contratos())->crearContrato(
            (new Arrendadores())->find(1),
            new Arrendatarios(Input::post('arrendatario')),
            new Propiedades(Input::post('propiedad')),
            new Fiadores(Input::post('fiador'))
        );

        if (file_exists($paths ['fullPathSavedContract'])) {
            header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
            header("Cache-Control: public");
            header("Content-Type: application/octet-stream");
            header("Content-Transfer-Encoding: Binary");
            header("Content-Length:".filesize($paths['fullPathSavedContract']));
            header("Content-Disposition: attachment; filename={$paths['fullNameSavedContract']}");
            readfile($paths['fullPathSavedContract']);

        } else {
            header($_SERVER["SERVER_PROTOCOL"] . " 500 ERROR");
            header("Cache-Control: public");
            header("Content-Type: application/json");
            $this->data = ['ok' => false];
        }





    }
}
