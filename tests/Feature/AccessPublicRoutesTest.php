<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Route;
use Tests\TestCase;

class AccessPublicRoutesTest extends TestCase
{
    use RefreshDatabase;

    /** @test**/
    public function test_access_to_public_routes()
    {
        $routes = Route::getRoutes();
        foreach ($routes as $route) {
            array_map(function ($middleware) use ($route) {
                // $explodedURI = str_split($route->uri());
                $explodedURI = preg_match('/[\{\}]/',$route->uri());
                if ($middleware == 'guest' && in_array('GET', $route->methods()) && !$explodedURI) {
                    $this->get(route($route->getName()))->assertOk();
                }
            }, $route->middleware());
        }
    }
}