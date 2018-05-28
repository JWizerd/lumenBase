<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->call('GET', '/accounts');
        $this->assertEquals(200, $response->status());
    }

    public function testAgain()
    {
        $this->json('GET', '/accounts')
            ->seeJson([
                'type' => 'Checking'
            ]);
    }
}
