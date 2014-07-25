<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 25/07/14
 * Time: 09:31
 */

namespace ScreenShooter\Tests;

use ScreenShooter\ScreenShooterS3Service;
use Dotenv;

\Dotenv::load(__DIR__.'/../../');

class ScreenShooterS3ServiceTest extends Base {


    public function __construct()
    {
        //strtotime(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected the timezone 'UTC' for now, but please set date.timezone to select your timezone.
        date_default_timezone_set('America/New_York');

    }

    /**
     * @test
     */
    public function uploadFile()
    {

        $example = new ScreenShooterS3Service();


        $fileName           = 'faces.jpg';
        $fileNameAndPath    = __DIR__ . '/../../../assets/' . $fileName;

        $key="test/".$fileName;


        $this->assertNotEmpty($example->upload($fileNameAndPath, $key));

        $this->assertNotEmpty($example->signedUrl($key));
        $this->assertNotEmpty($example->getPreSignedUrl($key));

        $this->assertNotEmpty($example->getFilesInFolder('test'));

    }


    /**
     * test
     */
    public function deleteFile()
    {

        $example = new ScreenShooterS3Service();

        $fileName           = 'faces.jpg';
        $key="test/".$fileName;

        $this->assertNotEmpty($example->delete($key));
    }



} 