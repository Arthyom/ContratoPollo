<?php
/**
 * KumbiaPHP web & app Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.
 *
 * @category   KumbiaPHP
 * @package    Helpers
 *
 * @copyright  Copyright (c) 2005 - 2023 KumbiaPHP Team (http://www.kumbiaphp.com)
 * @license    https://github.com/KumbiaPHP/KumbiaPHP/blob/master/LICENSE   New BSD License
 */

/**
 * Helper para crear Formularios de un modelo automáticamente.
 *
 * @category   KumbiaPHP
 * @package    Helpers
 */
class ModelForm
{
    /**
     * Genera un form de un modelo (objeto) automáticamente.
     *
     * @param object $model
     * @param string $action
     */
    public static function create($model, $action = ''): void
    {
        $model_name = lcfirst(get_class($model));
        if (!$action) {
            $action = ltrim(Router::get('route'), '/');
        }
        // separar para diferentes ORM u otros formatos json, ini, xml, array,...

        echo '<form action="', PUBLIC_PATH.$action, '" method="post" id="', $model_name, '" class="scaffold p-0">' , PHP_EOL;
        $pk = $model->primary_key[0];
        echo '<input id="', $model_name, '_', $pk, '" name="', $model_name, '[', $pk, ']" class="id" value="', $model->$pk , '" type="hidden">' , PHP_EOL;


        $fields = $model->fields;// array_diff($model->fields, [$model->_at, $model->_in, $model->primary_key]);
        //echo var_dump([$model->_at, $model->_in, $model->primary_key]);


        foreach ($fields as $field) {
            if($field != 'PrecioTexto' && $field != 'Id') {


                $tipo = trim(preg_replace('/(\(.*\))/', '', $model->_data_type[$field])); //TODO: recoger tamaño y otros valores
                $alias = $model->get_alias($field);
                $formId = $model_name.'_'.$field;
                $formName = $model_name.'['.$field.']';

                $classHtml = "class = 'form-control'";
                $required = 'required';

                echo "<div class='col-auto mt-3 p-0'>";
                if (in_array($field, $model->not_null)) {
                    $required = 'required';
                    if($field != 'PrecioTexto' && $field != 'Id') {
                        echo "<label class=\"required mb-0\">$alias</label>" , PHP_EOL;
                    }
                } else {
                    $required = '';
                    if($field != 'PrecioTexto' && $field != 'Id') {
                        echo "<label class='mb-0'>$alias </label>" , PHP_EOL;
                    }
                }

                echo '<div class="input-group">';

                if($required) {
                    echo '<div class="input-group-text">*</div>';
                }
                switch ($tipo) {
                    case 'tinyint': case 'smallint': case 'mediumint':
                    case 'integer': case 'int': case 'bigint':
                    case 'float': case 'double': case 'precision':
                    case 'real': case 'decimal': case 'numeric':
                    case 'year': case 'day': case 'int unsigned': // Números

                        if (strpos($field, '_id') !== false) {
                            echo Form::dbSelect($model_name.'.'.$field, null, null, 'Seleccione', '', $model->$field);
                            break;
                        }

                        echo "<input id=\"$formId\"  $required $classHtml type=\"number\" name=\"$formName\" value=\"{$model->$field}\">" , PHP_EOL;
                        break;

                    case 'date':
                        echo "<input id=\"$formId\"  $required $classHtml type=\"date\" name=\"$formName\" value=\"{$model->$field}\">" , PHP_EOL;
                        break;

                    case 'datetime': case 'timestamp':
                        echo "<input id=\"$formId\"  $required $classHtml type=\"datetime\" name=\"$formName\" value=\"{$model->$field}\">" , PHP_EOL;
                        break;

                    case 'enum': case 'set': case 'bool':
                        $enumList = explode(',', str_replace("'", '', substr($model->_data_type[$field], 5, (strlen($model->_data_type[$field]) - 6))));
                        echo "<select id=\"$formId\"  $required $classHtml class=\"select\" name=\"$formName\" >", PHP_EOL;
                        foreach ($enumList as $value) {
                            echo "<option value=\"{$value}\">$value</option>", PHP_EOL;
                        }
                        echo '</select>', PHP_EOL;
                        break;

                    case 'text': case 'mediumtext': case 'longtext': // Usar textarea
                    case 'blob': case 'mediumblob': case 'longblob':
                        echo "<textarea id=\"$formId\"  $required $classHtml name=\"$formName\">{$model->$field}</textarea>" , PHP_EOL;
                        break;

                    default: //text,tinytext,varchar, char,etc se comprobara su tamaño
                        if($field != 'PrecioTexto') {
                            echo "<input id=\"$formId\"  $required $classHtml type=\"text\" name=\"$formName\" value=\"{$model->$field}\">" , PHP_EOL;
                        }
                        break;
                }
                echo '</div>';

                echo "</div>";
            }
        }


        echo '<div class="row pt-3">';
        echo '<div class="col-6">';
        echo '<a href="../" class="btn btn-block btn-danger">Listado</a>';
        echo '</div>';

        echo '<div class="col-6">';
        echo '<input type="submit" value="Guardar" class=" btn btn-block btn-primary" />';
        echo '</div>';
        echo '</div>';

        echo '</form>' , PHP_EOL;
    }
}
