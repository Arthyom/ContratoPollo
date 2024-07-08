<?php


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
            if(strpos($response, 'FETCH_HEAD') !== false) {
                return true;
            }
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
        if(DB_STATE['reWrite']) {

            $sqlToUpdatePath = APP_PATH.'config/db.sql';
            $sqlToStorePath = APP_PATH."config/dbUpdating/dbBackUp_". date('Y_M_d_h_i_s_A') .".sql";
            $extras = "--no-create-info --compact  --ignore-table=arrendadores";

            $sqlToUpdate = $this->getSQLFileContent($sqlToUpdatePath);

            ///backup db data
            shell_exec("mysqldump $extras --user=frodo  --password=2010_F?! --host=localhost contratos > $sqlToStorePath");

            ///run db updating
            $connection = mysqli_connect("localhost", "frodo", "2010_F?!", "contratos");
            mysqli_multi_query($connection, $sqlToUpdate);
            while($connection->next_result());
            ///restor db data
            $sqlToStore = $this->getSQLFileContent($sqlToStorePath);
            mysqli_multi_query($connection, $sqlToStore);
            mysqli_close($connection);

            return true;
        }
        return true;
    }

    private function isFromAllowedOrign($data)
    {
        $repositoryResponse = $data['repository']['id'];
        return $repositoryResponse == $this->allowedOrigin;
    }

    private function getSQLFileContent($dbFilePath)
    {
        $file = fopen($dbFilePath, "r");
        $fileSize = filesize($dbFilePath);
        return fread($file, $fileSize);
    }
}
