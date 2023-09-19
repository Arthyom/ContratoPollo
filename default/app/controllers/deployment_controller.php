<?php

class DeploymentController extends PublicResourceController
{
    public function post()
    {
        try {
            //code...
            $deploy = new Deployment();
            $isDeployed  = $deploy->runMergeDeployment($this->param());
            $isDbUpdated = $deploy->runDbUpdating();
            $arePackagesInstalled = $deploy->runComposerInstall($this->param());

            if($isDeployed && $arePackagesInstalled) {
                return $this->data = 'ok';
            }

        } catch (\Throwable $th) {
            $this->error($th);
        }

    }
}
