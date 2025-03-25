<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Tests\Validations;

use App\Entity\Formation;
use DateInterval;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Description of FormationValidationsTest
 *
 * @author Moi
 */
class FormationValidationsTest extends KernelTestCase{
    
    public function getFormation(): Formation{
        return (new Formation())
                ->setTitle("Cours sur les tests");
    }
    
    public function assertError(Formation $formation, int $nbErreursAttendues, string $message=""){
        self::bootKernel();
        $validator = self::getContainer()->get(ValidatorInterface::class);
        $error = $validator->validate($formation);
        $this->assertCount($nbErreursAttendues, $error, $message);
    }
    public function testValidePublishedAtFormation(){
        $aujourdhui = new DateTime();
        $this->assertError($this->getFormation()->setPublishedAt($aujourdhui), 0, "aujourdhui devrait réussir");
        $hier = (new DateTime())->sub(new DateInterval("P1D"));
        $this->assertError($this->getFormation()->setPublishedAt($hier), 0, "hier devrait réussir");
    }
    
    public function testInvalidPublishedAtFormation(){
        $demain = (new DateTime())->add(new DateInterval("P1D"));
        $this->assertError($this->getFormation()->setPublishedAt($demain), 1, "demain devrait échouer");
        $plusTard = (new DateTime())->add(new DateInterval("P5D"));
        $this->assertError($this->getFormation()->setPublishedAt($plusTard), 1, "plusTard devrait échouer");
    }
}
