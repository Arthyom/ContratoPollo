<?php

require_once APP_PATH . 'config/config.php';

class Deployment
{
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
            if(strpos($response, $errorMessages['existingChanges'])) {
                throw new Exception("Error al realizar el deployment: $response", 1);
            }
            return strpos($response, 'FETCH_HEAD');
        }
        return false;
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
}
