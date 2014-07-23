<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 7/23/14
 * Time: 10:52 AM
 */

namespace ScreenShooter\Tests;

use ScreenShooter\ScreenShooterUploadCtrl;
use Dotenv;

\Dotenv::load(__DIR__.'/../../');

class ScreenShooterUploadCtrlTest extends Base {

    /**
     * @test
     */
    public function can_connect_to_amazon()
    {
        $sstCtrl = new ScreenShooterUploadCtrl();

        $this->assertNotEmpty($sstCtrl->upload(1,2,3));
    }

//    /**
//     * @test
//     */
//    public function can_not_connect_to_amazon()
//    {
//        $sstCtrl = new ScreenShooterUploadCtrl();
//        $this->assertNotEmpty($sstCtrl);
//    }

} 