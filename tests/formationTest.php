<?php

namespace App\Tests;

use App\Entity\Formation;
use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * Description of formationTest
 *
 * @author Moi
 */
class formationTest extends TestCase {
    
    public function testGetPublishedAtString(){
        $formation = new Formation();
        $formation->setPublishedAt(new DateTime("2023-01-04 17:00:12"));
        $this->assertEquals("04/01/2023", $formation->getPublishedAtString());
    }
}
