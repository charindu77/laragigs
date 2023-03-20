<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Route;
use Tests\TestCase;

class AccessPublicRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function __construct($name = null, array $data = array(), $dataName = "")
    {
        parent::__construct($name, $data, $dataName);
        $this->createApplication();

    }

    /** 
     * @test
     * @dataProvider publicUri
     * **/
    public function test_access_to_public_routes($uri)
    {
        $this->get($uri)->assertOk();
    }

    public function publicUri(): array
    {
        return array_values(
                collect(Route::getRoutes())
                ->filter(fn($route) => in_array('GET', $route->methods()))
                ->reject(fn($route) => in_array('auth', $route->gatherMiddleware()))
                ->reject(fn($route) => preg_match('/[\{\}]/', $route->uri()))
                ->reject(fn($route) => in_array(
                    $route->uri(),
                    [
                        'sanctum/csrf-cookie',
                        '_ignition/health-check',
                        'api/user',
                        '_debugbar/open',
                        '_debugbar/clockwork/{id}',
                        '_debugbar/assets/stylesheets',
                        '_debugbar/assets/javascript',
                    ]
                )
                )
                ->map(function ($route) {
                    return [$route->uri];
                })->all()
        );
    }
}