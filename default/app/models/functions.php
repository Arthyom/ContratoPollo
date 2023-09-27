<?php
define('APP_PATH', dirname(__DIR__).'/');
require_once APP_PATH . 'config/config.php';
class Functions 
{
    public function runComposerInstall()
    {

        $okInstallMessages = [
            'Nothing to install, update or remove',
            'installs'
        ];

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

    public function runDbUpdating()
    {
        if(DB_STATE['reWrite']) {
            $sqlToUpdatePath = APP_PATH.'config/db.sql';
            $sqlToStorePath = APP_PATH."config/dbUpdating/dbBackUp_". date('Y_M_d_h_i_s_A') .".sql";
            $extras = "--no-create-info --compact ";
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
        }
    }


    private function getSQLFileContent($dbFilePath)
    {
        $file = fopen($dbFilePath, "r");
        $fileSize = filesize($dbFilePath);
        return fread($file, $fileSize);
    }
}

$func = new Functions();

$func->runDbUpdating();
$func->runComposerInstall();