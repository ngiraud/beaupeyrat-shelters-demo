<?php

namespace Tests\Feature\Animal;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class StoreAnimalTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected User $user;

    protected string $route;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->route = route('animal.store');
    }

    public function test_can_create_an_animal(): void
    {
        $response = $this->authenticate($this->user)->postJson($this->route, [
            'name' => 'Gordon',
            'description' => 'Because he looks like Gordon from Batman',
            'birthdate' => '2024-02-04',
        ]);

        $response->assertCreated();

        $animal = Animal::where('name', 'Gordon')->first();

        $response->assertJson(function (AssertableJson $json) use ($animal) {
            $json->has('data', function (AssertableJson $json) use ($animal) {
                return $json->where('name', $animal->name)
                    ->where('description', $animal->description)
                    ->where('birthdate', $animal->birthdate->toJSON())
                    ->etc();
            });
        });
    }

    public function test_validation_rules_are_applied(): void
    {
        $response = $this->authenticate($this->user)->postJson($this->route);

        $response->assertJsonValidationErrors([
            'name',
            'description',
            'birthdate',
        ]);
    }

    public function test_birthdate_must_be_a_valid_date(): void
    {
        $response = $this->authenticate($this->user)->postJson($this->route, [
            'birthdate' => 'not-a-valid-date',
        ]);

        $response->assertJsonValidationErrorFor('birthdate');
    }

    public function test_unauthenticated_user_cannot_store_an_animal(): void
    {
        $response = $this->postJson($this->route);

        $response->assertUnauthorized();
    }
}
