<?php
/**
 * KumbiaPHP web & app Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.
 *
 * @category   Kumbia
 * @package    Cache
 * @subpackage Drivers
 *
 * @copyright  Copyright (c) 2005 - 2023 KumbiaPHP Team (http://www.kumbiaphp.com)
 * @license    https://github.com/KumbiaPHP/KumbiaPHP/blob/master/LICENSE   New BSD License
 */

/**
 * Cacheo de Archivos
 *
 * @category   Kumbia
 * @package    Cache
 * @subpackage Drivers
 */
class FileCache extends Cache
{

    /**
     * Obtiene el nombre de archivo a partir de un id y grupo
     *
     * @param string $id
     * @param string $group
     * @return string
     */
    protected function _getFilename($id, $group)
    {
        return 'cache_' . md5($id) . '.' . md5($group);
    }

    /**
     * Carga un elemento cacheado
     *
     * @param string $id
     * @param string $group
     * @return string|null
     */
    public function get($id, $group='default')
    {
        $this->_id = $id;
        $this->_group = $group;

        $filename = APP_PATH . 'temp/cache/' . $this->_getFilename($id, $group);
        if (is_file($filename)) {
            $fh = fopen($filename, 'r');

            $lifetime = trim(fgets($fh));
            if ($lifetime == 'undefined' || $lifetime >= time()) {
                $data = stream_get_contents($fh);
            } else {
                $data = null;
            }

            fclose($fh);
            return $data;
        }
    }

    /**
     * Guarda un elemento en la cache con nombre $id y valor $value
     *
     * @param string $id
     * @param string $group
     * @param string $value
     * @param int $lifetime tiempo de vida en forma timestamp de unix
     * @return bool
     */
    public function save($value, $lifetime='', $id='', $group='default')
    {
        if (!$id) {
            $id = $this->_id;
            $group = $this->_group;
        }

        if ($lifetime) {
            $lifetime = strtotime($lifetime);
        } else {
            $lifetime = 'undefined';
        }

        return (bool) file_put_contents(APP_PATH . 'temp/cache/' . $this->_getFilename($id, $group), "$lifetime\n$value");
    }

    /**
     * Limpia la cache
     *
     * @param string $group
     * @return boolean
     */
    public function clean($group='')
    {
        $pattern = $group ? APP_PATH . 'temp/cache/' . '*.' . md5($group) : APP_PATH . 'temp/cache/*';
        foreach (glob($pattern) as $filename) {
            if (!unlink($filename)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Elimina un elemento de la cache
     *
     * @param string $id
     * @param string $group
     * @return bool
     */
    public function remove($id, $group='default')
    {
        return unlink(APP_PATH . 'temp/cache/' . $this->_getFilename($id, $group));
    }

}
