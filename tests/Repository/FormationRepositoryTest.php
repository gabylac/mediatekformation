<?php


namespace App\Tests\Repository;

use App\Entity\Formation;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of FormationRepositoryTest
 *
 * @author Moi
 */
class FormationRepositoryTest extends KernelTestCase{
    
    public function recupRepository(): FormationRepository{
        self::bootKernel();
        $repository = self::getContainer()->get(FormationRepository::class);
        return $repository;
    }
    
    public function newFormation(): Formation{
        $formation = (new Formation())
                ->setTitle("Formation-test");
        return $formation;
    }
    
    public function testNbFormationByOnePlaylist(){
        $repository = $this->recupRepository();
        $nbFormationsPlaylist = $repository->nbFormationByOnePlaylist(39);        
        $this->assertEquals(4, $nbFormationsPlaylist);
    }
    
    public function testFindAllForOne(){
        $repository = $this->recupRepository();
        $formationsCategorie = $repository->findAllForOne(1);
        $nbFormationsCategorie = count($formationsCategorie);
        $this->assertEquals(16, $nbFormationsCategorie);
    }
}
