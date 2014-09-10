<?php
namespace RESTfony\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\QueryParam;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use RESTfony\ApiBundle\Helpers\Response;
use RESTfony\ApiBundle\Helpers\UUID;

class ImagesController extends FOSRestController{
    protected $mongodb;

    protected function setMongodb() {
        if($this->mongodb === null) {
            $this->mongodb = $this->get('doctrine_mongodb')->getManager();
        }
    }

    /**
     * Get the list of images
     *
     * @param ParamFetcher $paramFetcher
     * @return array data
     *
     * @QueryParam(name="offset", requirements="\d+", default="0", description="From which image to start")
     * @QueryParam(name="limit", requirements="\d+", default="20", description="Maximum number of images in the response (max allowed value: 1000.")
     * @QueryParam(name="sort", default="title", description="Sort order: a coma separated list of fields. For backward sorting, prefix the fieldname with a -")
     * @ApiDoc()
     */
    public function getImagesAction(ParamFetcher $paramFetcher) {
        $this->setMongodb();

        $offset = $paramFetcher->get("offset");
        $limit =  $paramFetcher->get("limit");
        $sort =   $paramFetcher->get("sort");

        $aSort = Response::getSort($sort, 'RESTfony\ApiBundle\Document\Image');

        // Headers
        $total_count = $this->mongodb->createQueryBuilder('RESTfonyApiBundle:Image')->getQuery()->execute()->count();
        $http_headers = array(
            "X-Total-Count" => $total_count,
            "Links" => Response::getLinks($this->get('router'),'get_images',$total_count,$limit,$offset,$sort)
        );

        // Body
        $images = Array('images' => $this->mongodb->getRepository('RESTfonyApiBundle:Image')->findBy(array(), $aSort, $limit, $offset));

        $view = $this->view($images,200,$http_headers);
        return $this->handleView($view);
    }

    public function getImageAction($uuid) {
        if(UUID::is_valid($uuid)) {
            $this->setMongodb();
            $image = $this->mongodb->getRepository('RESTfonyApiBundle:Image')->findOneByUuid($uuid);

            if($image === null) {
                return $this->handleView($this->view('',404));
            }
            return $this->handleView($this->view($image, 200));
        }
        return $this->handleView($this->view('',400));
    }
}