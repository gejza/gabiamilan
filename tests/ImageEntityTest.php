<?php

namespace App\Tests;

use App\Repository\ImageRepository;
use PHPUnit\Framework\TestCase;

class ImageEntityTest extends TestCase
{
    public function testSomething(ImageRepository $imageRepository)
    {
    	
    	$ret = $imageRepository->findAll();
    	var_dump($ret);
        $this->assertTrue(true);
    }
}
