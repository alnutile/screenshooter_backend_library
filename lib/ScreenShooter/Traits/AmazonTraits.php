<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 7/23/14
 * Time: 12:09 PM
 */

namespace ScreenShooter\Traits;


use Aws\Common\Aws;
use Aws\S3\Exception\S3Exception;

trait AmazonTraits {

    protected $bucket;
    protected $config = [];
    protected $key;
    protected $secret;
    protected $region;

    public function __construct()
    {
        $this->bucket   = $_ENV['S3_BUCKET'];
        $this->key      = $_ENV['S3_KEY'];
        $this->secret   = $_ENV['S3_SECRET'];
        $this->region   = $_ENV['S3_REGION'];
        $this->setConfig();
    }

    public function aws_factory($config)
    {
        return Aws::factory($config);
    }

    /**
     * @param mixed $bucket
     */
    public function setBucket($bucket)
    {
        $this->bucket = $bucket;
    }

    /**
     * @return mixed
     */
    public function getBucket()
    {
        return $this->bucket;
    }

    /**
     * @param array $config
     * @return $this
     */
    public function setConfig(array $config = null)
    {
        if($config === null)
        {
            $config = array(
                'key' => $this->getKey(),
                'secret' => $this->getSecret(),
                'region' => $this->getRegion()
            );
        }
        $this->config = $config;
        return $this;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return mixed
     */
    public function getSecret()
    {
        return $this->secret;
    }



} 