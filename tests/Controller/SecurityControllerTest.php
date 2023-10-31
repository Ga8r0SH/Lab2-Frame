<?php
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // Check if the login form is displayed on the page
        $this->assertSelectorTextContains('button', 'Sign in');

        // You can add more specific assertions to check the content and structure of the login page if needed.
    }
}
