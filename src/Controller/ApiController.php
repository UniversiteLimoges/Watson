<?php

namespace Watson\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Watson\Domain\Link;

class ApiController {

    /**
     * API links controller.
     *
     * @param Application $app Silex application
     *
     * @return All links in JSON format
     */
    public function getLinksAction(Application $app) {
        $links = $app['dao.link']->findAll();
        // Convert an array of objects ($links) into an array of associative arrays ($responseData)
        $responseData = array();
        foreach ($links as $link) {
            $responseData[] = $this->buildLinkArray($link);
        }
        // Create and return a JSON response
        return $app->json($responseData);
    }

    /**
     * API link details controller.
     *
     * @param integer $id Link id
     * @param Application $app Silex application
     *
     * @return Link details in JSON format
     */
    public function getLinkAction($id, Application $app) {
        $link = $app['dao.link']->find($id);
        $responseData = $this->buildLinkArray($link);
        // Create and return a JSON response
        return $app->json($responseData);
    }

    /**
     * API create link controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     *
     * @return Link details in JSON format
     */
    public function addLinkAction(Request $request, Application $app) {
        // Check request parameters
        if (!$request->request->has('lien_titre')) {
            return $app->json('Paramètre requis manquant : lien_titre', 400);
        }
        if (!$request->request->has('lien_url')) {
            return $app->json('Paramètre requis manquant : lien_url', 400);
        }

        // Build and save the new link
        $link = new Link();
        $link->setTitle($request->request->get('lien_titre'));
        $link->setUrl($request->request->get('lien_url'));
        if (!$request->request->has('lien_desc')) {
            $link->setDesc($request->request->get('lien_desc'));
        }
        
        $app['dao.link']->save($link);
        $responseData = $this->buildLinkArray($link);

        return $app->json($responseData, 201);  // 201 = Created
    }

    /**
     * API delete link controller.
     *
     * @param integer $id Link id
     * @param Application $app Silex application
     */
    public function deleteLinkAction($id, Application $app) {
        // Delete the link
        $app['dao.link']->delete($id);
        return $app->json('No Content', 204);  // 204 = No content
    }

    /**
     * Converts an Link object into an associative array for JSON encoding
     *
     * @param Link $link Link object
     *
     * @return array Associative array whose fields are the link properties.
     */
    private function buildLinkArray(Link $link) {
        $data  = array(
            'id' => $link->getId(),
            'lien_titre' => $link->getTitle(),
            'lien_url' => $link->getUrl(),
            'lien_desc' => $link->getDesc(),
        );
        return $data;
    }
}
