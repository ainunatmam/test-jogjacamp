<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Category;

class CategoryApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function setUp() :void
    {
        parent::setUp();
    }

    public function tearDown() :void
    {

        parent::tearDown();
    }

    public function test_it_can_access_index()
    {
        $response = $this->get('/api/category/');
        $response->assertStatus(200);
    }

    public function test_it_can_access_show()
    {
        $category = factory(Category::class)->make();
        $this->json('GET', '/api/category/'.$category->id)
        ->assertStatus(200);
    }

    public function test_it_cant_access_show()
    {
        $this->json('GET', '/api/category/asdads')
        ->assertStatus(404);
    }
    
    public function test_it_can_create_data()
    {
        $this->json('POST', '/api/category/store', [
            'name'          => 'test',
            'publish'    => 1
        ])
        ->assertStatus(201);
    }

    public function test_it_cant_create_data()
    {
        $this->json('POST', '/api/category/store', [
            'name'          => 'test',
            'publish'    => 4
        ])
        ->assertStatus(422);
    }

    public function test_it_can_update_data()
    {
        $category = factory(Category::class)->make();
        $this->json('PUT', '/api/category/update/'.$category->id, [
            'name'          => 'test',
            'publish'    => 1
        ])
        ->assertStatus(404);
    }

    public function test_it_can_delete_data()
    {
        $category = factory(Category::class)->make();
        $this->json('DELETE', '/api/category/delete/'.$category->id)
        ->assertStatus(404);
    }
}
