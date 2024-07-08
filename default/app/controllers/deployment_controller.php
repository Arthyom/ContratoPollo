<?php

class DeploymentController extends PublicResourceController
{
    public function post()
    {
        try {
            //code...
            $deploy = new Deployment();
            $isDeployed  = $deploy->runMergeDeployment($this->param());
            $isDbBacked = $deploy->runDbUpdating();

            if($isDeployed && $isDbBacked != null ) {
                exec("php ". APP_PATH . "models/functions.php > /dev/null 2>&1 &");
                return $this->data ='ok';
            }

        } catch (\Throwable $th) {
             $this->data = $this->error($th, 500);
        }

    }
}
