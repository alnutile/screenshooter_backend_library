<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 25/07/14
 * Time: 09:30
 */

namespace ScreenShooter;

use Carbon\Carbon;
use ScreenShooter\Traits\AmazonTraits;
use Flow\Config;
use Flow\Request;

class ScreenShooterS3Service
{
    use AmazonTraits;


    /**
     * Upload file to S3
     * @param $fileNameAndPath
     * @param $key
     * @return bool
     */
    public function upload($fileNameAndPath, $key)
    {
        $client = $this->s3_client($this->getConfig());

        try {
            $results = $client->upload(
                $this->getBucket(),
                $key,
                fopen($fileNameAndPath, 'r')
            );
            var_dump($results);
            return $results;

        } catch (S3Exception $e) {
            var_dump($e->getMessage());
        }

        return false;
    }


    /**
     * @param $key
     * @return bool
     */
    public function getPreSignedUrl($key)
    {
        $client = $this->s3_client($this->getConfig());

        try {
            // Get a pre-signed URL for an Amazon S3 object
            $signedUrl = $client->getObjectUrl($this->getBucket(), $key, '+10 minutes'); //+1 hour

            var_dump($signedUrl);
            return $signedUrl;

        } catch (S3Exception $e) {
            var_dump($e->getMessage());
        }

        return false;
    }


    /**
     * https://coderwall.com/p/pr-gwg
     *
     * @param $key
     * @return string
     */
    public function signedUrl($key){


        //request variables:

        $awsKeyId = $this->getKey();

        $awsSecret = $this->getSecret();

        $expires = time() + (10*60); //10 minutes

        $httpVerb = "GET";

        $contentMD5 = "";

        $contentType = "";

        $amzHeaders = "";

        $amzResource = "/".$this->getBucket()."/" . $key;


        //request to be signed:
        $request = sprintf("%s\n%s\n%s\n%s\n%s%s" , $httpVerb , $contentMD5 , $contentType , $expires , $amzHeaders , $amzResource );


        //signing:
        $base64signed = base64_encode( hash_hmac( 'sha1' , $request, $awsSecret , true ) );

        //the final url:
        $url = "https://s3.amazonaws.com%s?AWSAccessKeyId=%s&Expires=%s&Signature=%s";

        $url = sprintf( $url , $amzResource , $awsKeyId , $expires , $base64signed );

        var_dump($url);

        return $url;

    }






    /**
     * @param $key_prefix
     * @return bool
     */
    public function getFilesInFolder($key_prefix)
    {
        $client = $this->s3_client($this->getConfig());

        try {
            //Returns some or all (up to 1000) of the objects in a bucket. You can use the request parameters as selection criteria to return a subset of the objects in a bucket.
            $result = $client->listObjects(array(
                // Bucket is required
                'Bucket' => $this->getBucket(),
//            'Delimiter' => 'string',
//            'EncodingType' => 'string',
//            'Marker' => 'string',
//            'MaxKeys' => integer,
                'Prefix' => $key_prefix,
            ));
            var_dump($result);
            return $result;

        } catch (S3Exception $e) {
            var_dump($e->getMessage());
        }

        return false;
    }


    /**
     * @param $key
     * @return bool
     */
    public function delete($key)
    {

        $client = $this->s3_client($this->getConfig());

        try {
            $result = $client->deleteObject(array(
                // Bucket is required
                'Bucket' => $this->getBucket(),
                // Key is required
                'Key' => $key

            ));
            var_dump($result);
            return $result;

        } catch (S3Exception $e) {
            var_dump($e->getMessage());
        }

        return false;

    }


} 