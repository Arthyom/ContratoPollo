<?php

require_once APP_PATH . 'config/config.php';

class Deployment
{
    public $allowedOrigin = 682724886;

    public function runMergeDeployment($data)
    {
        $errorMessages = [
            'existingChanges' =>
            'error: Your local changes to the following files would be overwritten by merge'
        ];

        //code...
        $repositoryResponse = $data['repository']['id'];
        if ($repositoryResponse == 682724886) {
            $pull = "/usr/bin/git pull https://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@github.com/arthyom/ContratoPollo.git  master 2>&1";
            $response = shell_exec($pull);
            if(strpos($response, 'FETCH_HEAD') !== false) 
                return true;            
        }
        throw new Exception("Error origen no valido: $repositoryResponse", 1);
    }

    public function runComposerInstall($data)
    {
        $okInstallMessages = [
            'Nothing to install, update or remove',
            'installs'
        ];

        if($this->isFromAllowedOrign($data)) {
            putenv('COMPOSER_HOME=~/.config/composer');
            $command = "composer   update --working-dir  "  .dirname(__DIR__, 3) . " 2>&1";
            $response = shell_exec($command);

            $command = "composer   install --working-dir  "  .dirname(__DIR__, 3) . " 2>&1";
            $response = shell_exec($command);

            foreach ($okInstallMessages as $key => $value) {
                if((strpos($response, $value) > 0)) {
                    return true;
                }
            }
        }
        throw new Exception("Error al realizar el deployment: $response", 1);
    }

    public function runDbUpdating()
    {
        try {
            if(DB_STATE['reWrite']) {
                //$dbScriptPath = APP_PATH.'config/db.sql';

                // $file = fopen( $dbScriptPath, "r" );
                // $filesize = filesize( $dbScriptPath );
                // $filetext = fread( $file, $filesize );
                // fclose( $file );


                // $dbScriptPath = realpath($dbScriptPath);
                //  $command = "mysql  --user=frodo  --password=2010_F?! < ".$dbScriptPath;
                // $command2 = "source  $dbScriptPath";

                // $s = new Contratos();
                // echo(var_dump(exec($command .'/shellexec.sql')));
                // return;
            }

            return true;
        } catch (\Throwable $th) {
            //throw $th;
            echo var_dump($th);
        }

    }

    private function isFromAllowedOrign($data)
    {
        $repositoryResponse = $data['repository']['id'];
        return $repositoryResponse == $this->allowedOrigin;
    }
}
