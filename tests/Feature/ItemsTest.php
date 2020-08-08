<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ItemsTest extends TestCase
{
    use DatabaseMigrations;

    public function testIndex()
    {
        $items = factory('App\Item', 2)->create();

        $response = $this->get(route('items.index'));
        $response
            ->assertJsonPath('metadata.count', 2)
            ->assertStatus(200);
    }

    public function testShow()
    {
        $item = factory('App\Item')->create();

        $response = $this->get(route('items.show', ['item' => $item->_id]));
        $response
            ->assertStatus(200)
            ->assertSeeInOrder([$item->_id, $item->description]);
    }

    public function testShowNotFound()
    {
        $response = $this->get(route('items.show', ['item' => '1234567']));
        $response->assertStatus(404);
    }

    public function testStore()
    {
        $response = $this->postJson(route('items.store'), ['image' => 'myimage.png', 'description' => 'This is a description']);
        $data = $response->decodeResponseJson();
        $response
            ->assertStatus(201)
            ->assertLocation(route('items.show', ['item' => $data['data']['_id']]));
    }

    public function testStoreNoImage()
    {
        $response = $this->postJson(route('items.store'), ['description' => 'This is a description']);
        $data = $response->decodeResponseJson();
        $response->assertStatus(422);
    }

    public function testStoreImageEmpty()
    {
        $response = $this->postJson(route('items.store'), ['image' => '', 'description' => 'This is a description']);
        $data = $response->decodeResponseJson();
        $response->assertStatus(422);
    }
}
