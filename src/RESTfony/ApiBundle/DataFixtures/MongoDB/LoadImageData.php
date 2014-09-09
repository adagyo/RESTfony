<?php

namespace RESTfony\ApiBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use RESTfony\ApiBundle\Document\Image;

class LoadImageData implements FixtureInterface{
    function load(ObjectManager $manager) {

        for($i = 0; $i < 10; $i++) {
            $image = new Image();
            $image->genUuid();
            $image->setPath("c:\\docs\\image_$i.jpg");

            $manager->persist($image);
        }
        $manager->flush();
    }
}