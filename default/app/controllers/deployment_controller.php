<?php

class DeploymentController extends PublicResourceController
{
    public function post()
    {
        try {
            //code...
            $deploy = new Deployment();
            $idDeployed  = $deploy->runMergeDeployment($this->param());
            $idDbUpdated = $deploy->runDbUpdating();

            if($idDeployed && true) {
                return $this->data = 'ok';
            }
        } catch (\Throwable $th) {
            $this->error($th);
        }

    }
}
