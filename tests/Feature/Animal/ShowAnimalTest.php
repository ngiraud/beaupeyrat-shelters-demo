<?php

namespace Tests\Feature\Animal;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ShowAnimalTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected User $user;

    protected Animal $animal;

    protected string $route;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->animal = Animal::factory()->create([
            'name' => 'Houdini',
            'description' => 'This is actually my dog.',
            'birthdate' => '2013-09-01',
        ]);

        $this->route = route('animal.show', $this->animal);
    }

    public function test_can_show_an_animal(): void
    {
        $response = $this->authenticate($this->user)->getJson($this->route);

        $response->assertOk();

        $response->assertJson(function (AssertableJson $json) {
            $json->has('data', function (AssertableJson $json) {
                return $json->where('name', $this->animal->name)
                            ->where('description', $this->animal->description)
                            ->where('birthdate', $this->animal->birthdate->toJSON())
                            ->etc();
            });
        });
    }

    public function test_unauthenticated_user_cannot_store_an_animal(): void
    {
        $response = $this->getJson($this->route);

        $response->assertUnauthorized();
    }
}
