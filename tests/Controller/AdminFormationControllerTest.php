<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of AdminFormationControllerTest
 *
 * @author Moi
 */
class AdminFormationControllerTest extends WebTestCase{
    
    private function loginAsAdmin($client)
    {
        // Crée un utilisateur avec le rôle ROLE_ADMIN
        $user = static::getContainer()->get(UserRepository::class)->findOneBy(['username' => 'admin']);
        
        // Effectue l'authentification (avec un login manuel pour les tests)
        $client->loginUser($user);
    }
    
    public function testFiltreAdminFormations(){
        $client = static::createClient();
        $this->loginAsAdmin($client);
        $client ->request('GET', '/admin');
        //simulation de la soumission du formulaire
        $crawler = $client->submitForm('filtrer', ['recherche' =>'Déploiement']);
        //vérifie le nb de lignes obtenus
        $this ->assertCount(1, $crawler->filter('h5'));
        //vérifie si la playlist correspond à la recherche
        $this ->assertSelectorTextContains('h5', 'Déploiement');
    }
    
    public function testTriAdminFormationsAsc(){
        $client = static::createClient();
        $this->loginAsAdmin($client);
        $client->request('GET', 'admin/formations/tri/title/ASC');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);        
    }
    
    public function testTriAdminFormationsDesc(){
        $client = static::createClient();
        $this->loginAsAdmin($client);
        $client->request('GET', 'admin/formations/tri/title/DESC');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);        
    }
    
    public function testLinkAdminFormation(){
        $client = static::createClient();
        $this->loginAsAdmin($client);
        $client->request('GET', '/admin');
        $client->clickLink('Editer');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Gestion formation');
        $reponse = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $reponse->getStatusCode());
        $uri = $client->getRequest()->server->get("REQUEST_URI");
        $this->assertEquals('/admin/edit/9', $uri);
    }
}
