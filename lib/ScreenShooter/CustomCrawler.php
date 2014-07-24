<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 24/07/14
 * Time: 17:55
 */

namespace ScreenShooter;


include(__DIR__.'/../../vendor/cuab/phpcrawl/libs/PHPCrawler.class.php');

use PHPCrawler;
use PHPCrawlerDocumentInfo;

class CustomCrawler extends PHPCrawler
{

    public $urls;


    function initChildProcess()
    {

        $this->urls = array();

    }


    function handleDocumentInfo(PHPCrawlerDocumentInfo $PageInfo)
    {

        var_dump($PageInfo->url);
        var_dump($this->starting_url);

        $url_string = $PageInfo->url . '';

        $url_string = str_replace($this->starting_url, '', $url_string);

        $url = array('url' => '/' . $url_string);

        array_push($this->urls, $url);


    }

}