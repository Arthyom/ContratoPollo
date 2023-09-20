<?php

require_once APP_PATH . '../../vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

class Contratos extends ActiveRecord
{
    public function initialize()
    {
        //this->belongs_to('TargetModelName');
        //this->has_one('TargetModelName');
        //this->has_many('TargetModelName');
        //this->has_and_belongs_to_many('TargetModelName');
    }

    private function convertirMesEsp($englishMont)
    {
        switch ($englishMont) {
            case 'January': return 'Enero';
            case 'March': return 'Febrero';
            case 'April': return 'Marzo';
            case 'May': return 'Abril';

            case 'June': return 'Mayo';
            case 'July': return 'Junio';
            case 'August': return 'Agosto';
            case 'September': return 'Septiembre';

            case 'Octuber': return 'Octubre';
            case 'November': return 'Noviembre';
            case 'December': return 'Diciembre';
        }
    }

    public function crearContrato($arrendador, $arrendatario, $propiedad, $fiador)
    {
        $arrendador->begin();
        $propiedad->PrecioTexto = strtoupper(( new NumberFormatter("es-MEX", NumberFormatter::SPELLOUT) )->format($propiedad->Precio));
        if($arrendador->create() && $arrendatario->create() && $propiedad->create() && $fiador->create()) {

            $fileBasePath = APP_PATH.'temp/documentos/arrendamiento/';
            $fullNameSavedContract = "Contrato Arrendamiento $arrendatario->Nombre.docx";
            $fullPathSavedContract = $fileBasePath. $fullNameSavedContract;
            $templatePath = $fileBasePath.'ArrendamientoPlantilla.docx';
            $pdfFullPathSavedContract = "$fileBasePath/$fullNameSavedContract.pdf";
            $pdfFullNameSavedContract = "Contrato Arrendamiento $arrendatario->Nombre.pdf";
            $template = new TemplateProcessor($templatePath);

            $underLinedDic = [
                '${Arrendador.Nombre}' => $arrendador->Nombre,
                '${Arrendador.Direccion}' => $arrendador->Direccion,
                '${Arrendador.Colonia}' => $arrendador->Colonia,
                '${Arrendador.Municipio}' => $arrendador->Municipio,

                '${Arrendatario.Nombre}' => $arrendatario->Nombre ,
                '${Arrendatario.Direccion}' => $arrendatario->Direccion,
                '${Arrendatario.Colonia}' => $arrendatario->Colonia,
                '${Arrendatario.Municipio}' => $arrendatario->Municipio,

                '${Fiador.Nombre}' => $fiador->Nombre,
                '${Fiador.Direccion}' => $fiador->Direccion,
                '${Fiador.Colonia}' => $fiador->Colonia,
                '${Fiador.Municipio}' => $fiador->Municipio,

                '${Propiedad.Precio}' => ( new NumberFormatter("es-MEX", NumberFormatter::CURRENCY) )->format($propiedad->Precio) ,
                '${Propiedad.PrecioTexto}' => $propiedad->PrecioTexto,
                '${Propiedad.Direccion}' => $propiedad->Direccion,
                '${Propiedad.Colonia}' => $propiedad->Colonia,
                '${Propiedad.Municipio}' => $propiedad->Municipio,

                '${Contrato.FechaInicio}' => date('d/m/Y'),
                '${Contrato.FechaTermino}' => date('d/m/Y', strtotime('+1 year')),
                '${Contrato.FechaInicioLarga}' => date('d') . ' de '. $this->convertirMesEsp(date('F')) . ' del ' . date('Y'),
            ];

            $boldAndUnderlinedDic = [
                '${Arrendador.Nombre.Bold}' => $arrendador->Nombre,
                '${Arrendatario.Nombre.Bold}' => $arrendatario->Nombre,
                '${Fiador.Nombre.Bold}' => $fiador->Nombre,
            ];

            foreach ($boldAndUnderlinedDic as $key => $value) {
                $fixedKey = str_replace(['{', '}', '$'], '', $key);
                while(key_exists($fixedKey, $template->getVariableCount())) {
                    $boldAndUnderlined = (new TextRun())->addText($value, array('bold' => true, 'underline' => 'single'));
                    $template->setComplexValue($key, $boldAndUnderlined);
                }
            }

            foreach ($underLinedDic as $key => $value) {
                $fixedKey = str_replace(['{', '}', '$'], '', $key);
                while(key_exists($fixedKey, $template->getVariableCount())) {
                    $underlined = (new TextRun())->addText($value, array('bold' => false, 'underline' => 'single'));
                    $template->setComplexValue($key, $underlined);
                }
            }



            $template->saveAs($fullPathSavedContract);

            try {
                Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
                Settings::setPdfRendererPath('.');
                $phpWord = IOFactory::load($fullPathSavedContract, 'Word2007');
                $phpWord->save($pdfFullPathSavedContract, 'PDF');
                $fullNameSavedContract = $pdfFullNameSavedContract;
                $fullPathSavedContract = $pdfFullPathSavedContract;
            } catch (\Throwable $th) {
                //throw new Exception($th);
            }

            $arrendador->commit();

            return [
                'fullPathSavedContract' => $fullPathSavedContract,
                'fullNameSavedContract' => $fullNameSavedContract
            ];
        }

        return null;
    }
}
