<?php

namespace Tests\Feature\Animal;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ListAnimalTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected User $user;

    protected string $route;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->route = route('animal.index');
    }

    public function test_can_list_animals(): void
    {
        Animal::factory()->create(['name' => 'Gordon']);
        $this->travel(5)->minutes();
        Animal::factory()->create(['name' => 'Houdini']);

        $response = $this->authenticate($this->user)->getJson($this->route);

        $response->assertOk();

        $response->assertJson(function (AssertableJson $json) {
            $json->where('data.0.name', 'Houdini')
                ->where('data.1.name', 'Gordon')
                ->etc();
        });
    }

    public function test_unauthenticated_user_cannot_list_animals(): void
    {
        $response = $this->getJson($this->route);

        $response->assertUnauthorized();
    }
}
