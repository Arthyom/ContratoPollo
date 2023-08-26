<?php

class Deployment
{
    public function runMergeDeployment($data)
    {
        //code...
        $repositoryResponse = $data['repository']['id'];
        if ($repositoryResponse == 682724886) {
            $pull = "/usr/bin/git pull https://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@github.com/arthyom/ContratoPollo.git  master 2>&1";
            $response = shell_exec($pull);
            return strpos($response, 'FETCH_HEAD');
        }
        return false;
    }
}
