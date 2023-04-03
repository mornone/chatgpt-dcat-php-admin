<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testTheApplicationReturnsASuccessfulResponse()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
