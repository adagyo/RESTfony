<?php

namespace RESTfony\ApiBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use RESTfony\ApiBundle\Document\Image;

class LoadImageData implements FixtureInterface{
    function load(ObjectManager $manager) {

        for($i = 0; $i < 100; $i++) {
            $image = new Image();
            $image->genUuid();
            $image->setTitle("Image #$i");
            $image->setPath("http://docs/image_$i.jpg");

            $manager->persist($image);
        }
        $manager->flush();
    }
}