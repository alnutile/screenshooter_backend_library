<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 24/07/14
 * Time: 17:12
 */

namespace ScreenShooter\Tests;

use ScreenShooter\ScreenShooterCrawlSitemap;

class ScreenShooterCrawlSitemapTest extends Base {

    /**
     * @test
     */
    public function crawlSitemap()
    {
        $example = new ScreenShooterCrawlSitemap();
        $sitemap = 'http://screenshooterv2.stagingarea.us/sitemap-example.xml';
        $this->assertNotNull($example->crawl($sitemap));
    }

}