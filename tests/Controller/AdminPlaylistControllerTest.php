<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of AdminPlaylistsControllerTest
 *
 * @author Moi
 */
class AdminPlaylistControllerTest extends WebTestCase{
    
    private function loginAsAdmin($client)
    {
        // Crée un utilisateur avec le rôle ROLE_ADMIN
        $user = static::getContainer()->get(UserRepository::class)->findOneBy(['username' => 'admin']);
        
        // Effectue l'authentification (avec un login manuel pour les tests)
        $client->loginUser($user);
    }
    
    public function testFiltreAdminPlaylists(){
        $client = static::createClient();
        $this->loginAsAdmin($client);
        $client ->request('GET', 'admin/playlists');
        //simulation de la soumission du formulaire
        $crawler = $client->submitForm('filtrer', ['recherche' =>'Base']);
        //vérifie le nb de lignes obtenus
        $this ->assertCount(1, $crawler->filter('h5'));
        //vérifie si la playlist correspond à la recherche
        $this ->assertSelectorTextContains('h5', 'Base');
    }
    
    public function testTriAdminPlaylistsAsc(){
        $client = static::createClient();
        $this->loginAsAdmin($client);
        $client->request('GET', 'admin/playlists/tri/ASC');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);        
    }
    
    public function testTriAdminPlaylistsDesc(){
        $client = static::createClient();
        $this->loginAsAdmin($client);
        $client->request('GET', 'admin/playlists/tri/DESC');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);        
    }
    
    public function testLinkAdminPlaylist(){
        $client = static::createClient();
        $this->loginAsAdmin($client);
        $client->request('GET', 'admin/playlists');
        $client->clickLink('Editer');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Gestion playlist');
        $reponse = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $reponse->getStatusCode());
        $uri = $client->getRequest()->server->get("REQUEST_URI");
        $this->assertEquals('/admin/playlist/edit/13', $uri);
    }
}
