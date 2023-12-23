<?php

class ArrendatariosController extends ScaffoldController
{
    public $model = 'arrendatarios';
    public $father ;

    /**
     * Resultados paginados
     *
     * @param int $page  Página a mostrar
     */
    public function index($page = 1)
    {
        $this->data = (new $this->model())->paginate("page: $page", 'order: id desc');
    }

    public function recibos($arrendatarioId, $pagado = true)
    {
        View::template(null);
        View::select(null);

        try {
            $currentArrendatario = (new Arrendatarios())->find($arrendatarioId);
            $currentProperty = $currentArrendatario->propiedades;
            $currentRecipe = new recibo();

            $currentRecipe->Total = $currentProperty->Precio;
            $currentRecipe->Importe = $currentProperty->Precio;
            $currentRecipe->PrecioUnitario = $currentProperty->Precio;
            $currentRecipe->ReceptorNombre = $currentArrendatario->Nombre;
            $currentRecipe->arrendatarios_id = $arrendatarioId;
            $currentRecipe->Concepto = "Pago renta " . date('M - Y') . " $currentProperty->Direccion";
            $currentRecipe->Pagado = $pagado;

            $paths =  $currentRecipe->crearRecibo($currentRecipe);
            // $pathsName = $paths['fullNameSavedContract'];
            // $contentDisp = "Content-Disposition: attachment; filename=". '"'. $pathsName .'"';

            if (file_exists($paths ['fullPathSavedContract'])) {
                header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
                header("Cache-Control: public");
                header("Content-Type: application/octet-stream");
                header("Content-Transfer-Encoding: Binary");
                header("Content-Length:".filesize($paths['fullPathSavedContract']));
                header("Content-Disposition: attachment; filename=\"{$paths['fullNameSavedContract']}\"");
                readfile($paths['fullPathSavedContract']);
            } else {
                header($_SERVER["SERVER_PROTOCOL"] . " 500 ERROR");
                header("Cache-Control: public");
                header("Content-Type: application/json");
                $this->data = ['ok' => false];
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo var_dump($th);
        }

    }

    public function historial($arrendatarioId)
    {
        $this->father = (new Arrendatarios())->find($arrendatarioId);
        $this->data = (new Recibo())->paginate(" arrendatarios_id = $arrendatarioId");
    }

    public function marcar($arrendatarioId, $id, $creado = true)
    {



        try {
            $item = (new Recibo())->find($id);
            $item->Pagado = $creado;
            $item->update($item);
            Redirect::to("$this->controller_name/historial/$arrendatarioId");

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
