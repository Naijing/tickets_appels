<?php

namespace TicketsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TicketsControllerTest extends WebTestCase
{
    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/add');
    }

    public function testQuery()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/query');
    }

}
