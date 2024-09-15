<?php

namespace Tests\Feature\Species;

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

//use App\Models\Species;

class StoreSpeciesTest extends TestCase
{
    protected User $user;

    protected string $route;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->route = route('species.store');
    }

    public function test_can_create_an_animal(): void
    {
        $response = $this->authenticate($this->user)->postJson($this->route, [
            'name' => 'Chien',
        ]);

        $response->assertCreated();

        $species = Species::where('name', 'Chien')->first();

        $response->assertJson(function (AssertableJson $json) use ($species) {
            $json->has('data', function (AssertableJson $json) use ($species) {
                return $json->where('name', $species->name)
                            ->etc();
            });
        });
    }

    public function test_validation_rules_are_applied(): void
    {
        $response = $this->authenticate($this->user)->postJson($this->route);

        $response->assertJsonValidationErrors([
            'name',
        ]);
    }

    public function test_unauthenticated_user_cannot_store_an_animal(): void
    {
        $response = $this->postJson($this->route);

        $response->assertUnauthorized();
    }
}
