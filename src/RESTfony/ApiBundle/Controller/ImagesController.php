<?php
namespace RESTfony\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;

class ImagesController extends FOSRestController{
    public function getImagesAction() {
        $images = $this->get('doctrine_mongodb')->getManager()->getRepository('RESTfonyApiBundle:Image')->findAll();

        $view = $this->view($images);
        return $this->handleView($view, 200);
    }
}