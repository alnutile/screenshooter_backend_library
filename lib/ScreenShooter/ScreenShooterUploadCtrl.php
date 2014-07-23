<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 7/23/14
 * Time: 10:54 AM
 */

namespace ScreenShooter;

use Carbon\Carbon;
use ScreenShooter\Traits\AmazonTraits;
use Flow\Config;
use Flow\Request;

class ScreenShooterUploadCtrl {
    use AmazonTraits;

    /**
     *
     * Upload a file or a Job/Task
     *
     * @param $site_id
     * @param $sitemap_id
     * @param $sitemap_url_id
     * @return bool
     */
    public function upload($site_id, $sitemap_id, $sitemap_url_id)
    {
        //1. take the get request
        //2. save the results to temp folder using Flow
        //3. save to queue the request
        //
        //  ['class' => 'ScreenShooter\QueueServices\ScreenShooterUploadService@fire',
        //      'params' => [$site_id, $sitemap_id, $sitemap_url_id]
        //
        //4. tell the user all is set

        $aws = $this->aws_factory($this->getConfig());

        $client             = $aws->get('S3');
        $fileName           = 'faces.jpg';
        $fileNameAndPath    = __DIR__ . '/../../assets/' . $fileName;
        $key_prefix         = 'site_' . $site_id . '/sitemap_' . $sitemap_id . '/url_' . $sitemap_url_id . '/';
        $key                = $key_prefix . $fileNameAndPath;

        try {
            $results = $client->upload(
                $this->getBucket(), 'faces.jpg', fopen($fileNameAndPath, 'r'), 'public-read'
            );
            var_dump($results);
            return $results;
        } catch (S3Exception $e) {
            echo $e->getMessage();
        }

        return false;
    }

    /**
     * Delete File
     * @param $key
     */
    public function delete($key)
    {

    }

    /**
     * All Assets for a job
     * @param $job_id
     */
    public function index($job_id)
    {

    }
} 