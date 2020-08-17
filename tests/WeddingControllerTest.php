<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WeddingControllerTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testIndex($url, $cont = ''): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $url);
        $this->assertResponseIsSuccessful();
        if ($cont != '') {
            $this->assertSelectorTextContains('h2', $cont);

        }
    }

    public function urlProvider()
    {
        yield ['/svatba'];
        yield ['/svatba/sraz'];
        yield ['/svatba/obrad','Ohraz'];
        yield ['/svatba/obed'];
        yield ['/svatba/raut'];
        yield ['/svatba/dort'];
        yield ['/svatba/zabava'];
    }
}
