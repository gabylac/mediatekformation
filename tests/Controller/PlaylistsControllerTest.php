<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of PlaylistsControllerTest
 *
 * @author Moi
 */
class PlaylistsControllerTest extends WebTestCase{
    
    public function testFiltrePlaylists(){
        $client = static::createClient();
        $client ->request('GET', '/playlists');
        //simulation de la soumission du formulaire
        $crawler = $client->submitForm('filtrer', ['recherche' =>'Base']);
        //vérifie le nb de lignes obtenus
        $this ->assertCount(1, $crawler->filter('h5'));
        //vérifie si la playlist correspond à la recherche
        $this ->assertSelectorTextContains('h5', 'Base');
    }
        
    public function testLinkPlaylist(){
        $client = static::createClient();
        $client->request('GET', '/playlists');
        $client->clickLink('Voir détail');
        $reponse = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $reponse->getStatusCode());
        $uri = $client->getRequest()->server->get("REQUEST_URI");
        $this->assertEquals('/playlists/playlist/13', $uri);
    }    
    
    public function testTriPlaylistsAsc(){
        $client = static::createClient();
        $client->request('GET', '/playlists/tri/name/ASC');
        $this->assertResponseIsSuccessful();        
    }
    
    public function testTriPlaylistsDesc(){
        $client = static::createClient();
        $client->request('GET', '/playlists/tri/name/DESC');
        $this->assertResponseIsSuccessful();        
    }
}
