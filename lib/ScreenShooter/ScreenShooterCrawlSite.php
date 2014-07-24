<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 24/07/14
 * Time: 17:31
 */

namespace ScreenShooter;



class ScreenShooterCrawlSite {

    /**
     * @param $site_url
     */
    public function crawl($site_url)
    {


        // It may take a whils to crawl a site ...
        set_time_limit(1000);


        // Now, create a instance of your class, define the behaviour
        // of the crawler (see class-reference for more options and details)
        // and start the crawling-process.

        $crawler = new CustomCrawler();

        // URL to crawl

        $parse = parse_url($site_url);
        var_dump($parse['scheme']);

        $crawler->setURL($parse['host']);
        //"phpcrawl.cuab.de"

        // Only receive content of files with content-type "text/html"
        $crawler->addContentTypeReceiveRule("#text/html#");

        // Ignore links to pictures, dont even request pictures
        $crawler->addURLFilterRule("#\.(jpg|jpeg|gif|png|css|js)$# i");

        // Store and send cookie-data like a browser does
        $crawler->enableCookieHandling(true);

        // Set the traffic-limit to 1 MB (in bytes,
        // for testing we dont want to "suck" the whole site)
        $crawler->setTrafficLimit(1000 * 1024);

        #just for testing!!
        $crawler->setPageLimit(10);

        // Thats enough, now here we go
        $crawler->go();

        // At the end, after the process is finished, we print a short
        // report (see method getProcessReport() for more information)
        $report = $crawler->getProcessReport();


        var_dump("Links followed: " . $report->links_followed);
        var_dump("Documents received: " . $report->files_received);
        var_dump("Bytes received: " . $report->bytes_received . " bytes");
        var_dump("Process runtime: " . $report->process_runtime . " sec");


        var_dump($crawler->urls);

        return $crawler->urls;

    }
}

