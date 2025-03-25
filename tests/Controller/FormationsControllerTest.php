<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of FormationsControllerTest
 *
 * @author Moi
 */
class FormationsControllerTest extends WebTestCase{
    
    public function testFiltreFormations(){
        $client = static::createClient();
        $client ->request('GET', '/formations');
        //simulation de la soumission du formulaire
        $crawler = $client->submitForm('filtrer', ['recherche' =>'Déploiement']);
        //vérifie le nb de lignes obtenus
        $this ->assertCount(1, $crawler->filter('h5'));
        //vérifie si la playlist correspond à la recherche
        $this ->assertSelectorTextContains('h5', 'Déploiement');
    }
    
    public function testTriFormationsAsc(){
        $client = static::createClient();
        $client->request('GET', '/formations/tri/title/ASC');
        $this->assertResponseIsSuccessful();        
    }
    
    public function testTriFormationsDesc(){
        $client = static::createClient();
        $client->request('GET', '/formations/tri/title/DESC');
        $this->assertResponseIsSuccessful();        
    }
    
    public function testLinkFormation(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/formations');
        //trouve tous les liens de la page html et récupère le neuvième pour cliquer dessus
        $link = $crawler->filter('a')->eq(9)->link();
        $crawler = $client->click($link);        
        $reponse = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $reponse->getStatusCode());
        $uri = $client->getRequest()->server->get("REQUEST_URI");
        $this->assertEquals('/formations/formation/1', $uri);
    }   
}
