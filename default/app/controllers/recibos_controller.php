<?php



/**
 * Controller por defecto si no se usa el routes
 *
 */
class RecibosController extends AppController
{
    public function index()
    {

    }


    public function crearRecibo()
    {
        View::select(null);
        View::template(null);

        try {
            $recibo = new Recibo(Input::post('recibo'));
            $paths = (new Recibo())->crearRecibo(
                $recibo
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
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
