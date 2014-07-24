<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 24/07/14
 * Time: 17:04
 */


namespace ScreenShooter;


class ScreenShooterCrawlSitemap
{

    /**
     * @param $sitemap_url
     * @return bool
     */
    public function crawl($sitemap_url)
    {

        var_dump($sitemap_url);


        if (isset($sitemap_url) && $sitemap_url != '') {
            $url = trim($sitemap_url);

            parse_url($url);

            $parse = parse_url($url);
            var_dump($parse['host']);
            var_dump($parse['scheme']);

            $domain_url = $parse['host'] . "://" . $parse['host'];


            try {
                $xml = simplexml_load_file($url);
                foreach ($xml->url as $url_list) {

                    $url_string = $url_list->loc . '';
                    $url_string = str_replace($domain_url, '', $url_string);
//                var_dump($url_list->loc);
                    $url = array('url' => $url_string);
                    $url_array[] = $url;
                }
                var_dump($url_array);

            } catch (S3Exception $e) {
                echo $e->getMessage();
                return null;
            }
            return $url_array;

        } else {
            var_dump("No xml url inserted");
            return null;
        }

    }

}