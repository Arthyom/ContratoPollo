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

            if($idDeployed && $idDbUpdated) {
                $this->data = $idDbUpdated;
            }
        } catch (\Throwable $th) {
            $this->error($th);
        }

    }
}
