<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 7/23/14
 * Time: 12:52 PM
 */

namespace ScreenShooter\QueueServices;


class ScreenShooterUploadService implements QueueInterface {
    use AmazonTraits;
    public function fire($job_id, $params)
    {
        $aws = $this->aws_factory($this->getConfig());
        $this->upload($params);

    }

    protected function upload($params)
    {


    }
} 