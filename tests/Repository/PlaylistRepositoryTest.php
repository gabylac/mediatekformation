<?php


namespace App\Tests\Repository;

use App\Entity\Playlist;
use App\Repository\PlaylistRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of PlaylistRepositoryTest
 *
 * @author Moi
 */
class PlaylistRepositoryTest extends KernelTestCase{
    
    public function recupRepository(): PlaylistRepository{
        self::bootKernel();
        $repository = self::getContainer()->get(PlaylistRepository::class);
        return $repository;
    }
    
    public function newPlaylist(): Playlist{
        $playlist = (new Playlist())
                ->setName("Playlist-test");
        return $playlist;
    }
    
    public function testFindAllOrderByFormation(){
        $repository = $this->recupRepository();        
        $playlists = $repository->findAllOrderByFormation('ASC');
        $nbPlaylists = count($playlists);
        $this->assertEquals(32, $nbPlaylists);        
    }
}
