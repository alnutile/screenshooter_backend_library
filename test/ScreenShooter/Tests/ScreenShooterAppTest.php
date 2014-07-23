<?php

namespace ScreenShooter\Tests;

use ScreenShooter\ScreenShooterApp;


class ScreenShooterAppTest extends Base {

    /**
     * @test
     */
    public function shouldReturnTrue()
    {
        $example = new ScreenShooterApp();

        $this->assertTrue($example->returnTrue());
    }

}
