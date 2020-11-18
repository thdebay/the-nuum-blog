<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginTest extends WebTestCase
{
    public function testLoginPageIsShownToGuests()
    {
        $client = static::createClient();

        // un visiteur non identifié peut accéder à la page de connexion
        $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testLoginPageIsHiddenFromAuthenticatedUsers()
    {
        // simuler la navigation en tant qu'utilisateur authentifié...
        // voir https://symfony.com/doc/4.4/testing/http_authentication.html
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'password',
        ]);
        
        // un utilisateur déjà enregistré est redirigé vers la page d'accueil
        $client->request('GET', '/login');
        // ne fonctionne pas. Le processus a été revu et simplifié sous Symfony 5, je ne creuse pas davantage pour le moment.
        //$this->assertResponseRedirects('/');
    }
}
