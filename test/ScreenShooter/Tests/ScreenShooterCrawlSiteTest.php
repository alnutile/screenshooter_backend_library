<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 24/07/14
 * Time: 17:35
 */

namespace ScreenShooter\Tests;


use ScreenShooter\ScreenShooterCrawlSite;

class ScreenShooterCrawlSiteTest extends Base  {


    /**
     * @test
     */
    public function crawlSitemap()
    {
        $example = new ScreenShooterCrawlSite();
        $site = 'http://www.cnn.com';
        $this->assertNotNull($example->crawl($site));
    }
} 