<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 25/07/14
 * Time: 14:49
 */

namespace ScreenShooter\Tests;


use PHPPdf;
use PHPPdf\DataSource\DataSource;
use Twig_Loader_Filesystem;
use Twig_Environment;

class ScreenShooterPdfTest  extends Base {


    public function __construct()
    {
        //strtotime(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected the timezone 'UTC' for now, but please set date.timezone to select your timezone.
        date_default_timezone_set('America/New_York');

    }


    /**
     * @test
     */
    public function pdf()
    {




//        $builder = PHPPdf\Core\FacadeBuilder::create(/* you can pass specyfic configuration loader object */)
//            ->setCache('File', array('cache_dir' => __DIR__ . '/../../../cache'))   //./cache
//            ->setUseCacheForStylesheetConstraint(true); //stylesheets will be also use cache
//
//        $facade = $builder->build();


        $facade = PHPPdf\Core\FacadeBuilder::create()->build();


        //$documentXml and $stylesheetXml are strings contains XML documents, $stylesheetXml is optional

        $path_assets = __DIR__ . '/../../../assets/pdf/';

        $path_temp = __DIR__ . '/../../../temp/';


        var_dump($path_assets.'document.xml');
        var_dump(DataSource::fromFile($path_assets.'document.xml'));
        var_dump(file_get_contents($path_assets.'document.xml'));

        $loader = new Twig_Loader_Filesystem($path_assets);
        $twig = new Twig_Environment($loader);


        $object = (object) ['username' => 'Here we go'];
        $users = array($object,$object,$object);



        //Render document with twig
        $document = $twig->render('document.xml', array('name' => 'Fabien' , 'users' => $users));

        $content = $facade->render( $document, DataSource::fromFile($path_assets.'stylesheet.xml')->read(), DataSource::fromFile($path_assets.'colors.xml')->read());

        file_put_contents($path_temp.'a.pdf', $content);



    }

} 