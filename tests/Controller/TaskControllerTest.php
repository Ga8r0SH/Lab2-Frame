<?php
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    

    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/task/list');

        // Follow the redirect after accessing the list page
        $crawler = $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // You can add more assertions here to check the content of the list page.
    }

    public function testDelete()
    {
        $client = static::createClient();

        // Replace {id} with an actual task ID that you want to test
        $taskId = 1;

        $client->request('GET', "/task/delete/{$taskId}");

        // Check if the response is a redirect
        $this->assertTrue($client->getResponse()->isRedirect());

        // Follow the redirect to check the new location
        $crawler = $client->followRedirect();

        // You can also add assertions to verify that the task was deleted.
    }

    public function testView()
    {
        $client = static::createClient();

        // Replace {id} with an actual task ID that you want to test
        $taskId = 1;

        $crawler = $client->request('GET', "/task/view/{$taskId}");

        // Follow the redirect after accessing the view page
        $crawler = $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // You can add assertions to check the content of the view page.
    }

    
}
