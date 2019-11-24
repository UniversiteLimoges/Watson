<?php

namespace Watson\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

class RssController {

     /**
     * User login controller.
     *
     * @param Application $app Silex application
     */
    public function rssAction(Application $app) {
        $links = $app['dao.link']->findFifteenLinksForRss();
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<Links>';
        
        // var_dump($links['15']->getUser()->getUsername());
        foreach($links as $key => $link) {
            $xml .= '<link link_id="'.$link->getId().'">';
            $xml .= '<title>'.$link->getTitle().'</title>';
            $xml .= '<url>'.$link->getUrl().'</url>';
            $xml .= '<desc>'.$link->getDesc().'</desc>';
            $xml .= '<user>'.$link->getUser()->getUsername().'</user>';
            $xml .= '</link>';
        }
        $xml .= '</Links>';
  
        $response = new Response($xml);
        $response->headers->set('Content-Type', 'xml');
        
        return $response;

        // $dom = new \DOMDocument();
        // $dom->encoding = 'utf-8';
        // $dom->xmlVersion = '1.0';
        // $dom->formatOutput = true;

        // $xml_file_name = './rss/rss.htm.twig';
        // $xml_file_name = '../views/rss.xml';

        // $root = $dom->createElement('Movies');
        // $movie_node = $dom->createElement('movie');

        // $attr_movie_id = new \DOMAttr('movie_id', '5467');
        // $movie_node->setAttributeNode($attr_movie_id);

        // $child_node_title = $dom->createElement('Title', 'The Campaign');
        // $movie_node->appendChild($child_node_title);

        // $child_node_year = $dom->createElement('Year', 2012);
        // $movie_node->appendChild($child_node_year);

        // $child_node_genre = $dom->createElement('Genre', 'The Campaign');
        // $movie_node->appendChild($child_node_genre);

        // $child_node_ratings = $dom->createElement('Ratings', 6.2);
        // $movie_node->appendChild($child_node_ratings);

        // $root->appendChild($movie_node);
        // $dom->appendChild($root);

        // print_r($dom);
        // $dom->saveXML();

        // $dom->save($xml_file_name);
        // $dom->save($xml_file_name);
      
        // return "<a href='./test.xml'>$xml_file_name</a> a été crée";
        // return $this->render('rss.xml');

        // $app['twig']->render('rss.xml');
    }
}
