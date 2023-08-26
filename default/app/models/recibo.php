<?php

require_once APP_PATH . '../../vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Element\TextRun;

class Recibo extends ActiveRecord
{
    protected $source = 'recibos';
    public function initialize()
    {
        //this->belongs_to('TargetModelName');
        //this->has_one('TargetModelName');
        //this->has_many('TargetModelName');
        //this->has_and_belongs_to_many('TargetModelName');
    }

    public function crearRecibo($recibo)
    {
        $recibo->FechaHoraEmision = date('Y-m-d H:i:s', strtotime('-1 hour'));
        $recibo->Importe = $recibo->PrecioUnitario * 1;
        $recibo->Total = $recibo->PrecioUnitario * 1;
        $recibo->PrecioTexto = strtoupper(( new NumberFormatter("es-MEX", NumberFormatter::SPELLOUT) )->format($recibo->Total));
        $recibo->IdentificadorUnico = uniqid() .' - '. $recibo->Concepto ;

        $recibo->begin();
        if($recibo->create()) {

            $fileBasePath = APP_PATH.'temp/documentos/recibos/';
            $fullNameSavedContract = "Recibo $recibo->IdentificadorUnico $recibo->ReceptorNombre .docx";
            $fullPathSavedContract = $fileBasePath. $fullNameSavedContract;
            $templatePath = $fileBasePath.'ReciboPlantilla.docx';
            $template = new TemplateProcessor($templatePath);




            $underLinedDic = [
                '${Recibo.FechaHoraEmision}' => date('d/m/Y H:i:s', strtotime($recibo->FechaHoraEmision)),
                '${Recibo.IdentificadorUnico}' => $recibo->IdentificadorUnico,
                '${Recibo.Concepto}' => $recibo->Concepto,
                '${Recibo.PrecioUnitario}' => ( new NumberFormatter("es-MEX", NumberFormatter::CURRENCY) )->format($recibo->PrecioUnitario),
                '${Recibo.Importe}' => ( new NumberFormatter("es-MEX", NumberFormatter::CURRENCY) )->format($recibo->Importe)
            ];

            $boldAndUnderlinedDic = [
                '${Recibo.Receptor.Nombre}' => $recibo->ReceptorNombre,
                '${Recibo.Total}' => ( new NumberFormatter("es-MEX", NumberFormatter::CURRENCY) )->format($recibo->Total),
                '${Recibo.PrecioTexto}' => $recibo->PrecioTexto
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
            $recibo->commit();

            return [
                'fullPathSavedContract' => $fullPathSavedContract,
                'fullNameSavedContract' => $fullNameSavedContract
            ];

        }

        return null;
    }
}
