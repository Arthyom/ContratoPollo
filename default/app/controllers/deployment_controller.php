<?php

require_once APP_PATH . '../../vendor/autoload.php';

use React\Promise\Deferred;

class DeploymentController extends PublicResourceController
{
    public function post()
    {
        try {
            //code...
            $deferred = new Deferred();
            $promise = $deferred->promise();
            $deploy = new Deployment();
            $isDeployed  = $deploy->runMergeDeployment($this->param());

            if($isDeployed) {
                $promise->then(
                    function () {
                        $deploy = new Deployment();
                        $deploy->runDbUpdating();
                        $deploy->runComposerInstall($this->param());
                    }
                );

                $this->data = 'ok';
                $deferred->resolve(true);
                return;
            }

        } catch (\Throwable $th) {
            $this->error($th, 500);
        }

    }
}
