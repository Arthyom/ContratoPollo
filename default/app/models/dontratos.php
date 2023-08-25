<?php

require_once APP_PATH . '../../vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Element\TextRun;
use Gears\Pdf;

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
            case 'Agusto': return 'Agosto';
            case 'Agusto': return 'Agosto';
            case 'Agusto': return 'Agosto';

            case 'January': return 'Enero';
            case 'Agusto': return 'Agosto';
            case 'Agusto': return 'Agosto';
            case 'Agusto': return 'Agosto';

            case 'January': return 'Enero';
            case 'August': return 'Agosto';
            case 'Agusto': return 'Agosto';
            case 'Agusto': return 'Agosto';

        }
    }

    public function crearContrato($arrendador, $arrendatario, $propiedad, $fiador)
    {
        $arrendador->begin();
        if($arrendador->create() && $arrendador->create() && $arrendador->create()) {

            $fileBasePath = APP_PATH.'temp/documentos/arrendamiento/';
            $fullNameSavedContract = "Contrato Arrendamiento $arrendatario->Nombre.docx";
            $fullPathSavedContract = $fileBasePath. $fullNameSavedContract;
            $templatePath = $fileBasePath.'arrendamiento.docx';
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

                '${Propiedad.Precio}' => $propiedad->Precio ,
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
            // Pdf::convert($fileBaseName.'save.docx', $fileBaseName.'save.pdf');
            $arrendador->commit();

            return [
                'fullPathSavedContract' => $fullPathSavedContract,
                'fullNameSavedContract' => $fullNameSavedContract
            ];

        }

        return null;
    }
}
