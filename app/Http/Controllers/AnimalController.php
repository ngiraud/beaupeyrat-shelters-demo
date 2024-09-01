<?php

namespace App\Http\Controllers;

use App\Actions\Animal\StoreAnimalAction;
use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;
use App\Http\Resources\AnimalResource;
use App\Models\Animal;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class AnimalController extends Controller
{
    /**
     * Display a listing of animals.
     *
     * @response AnonymousResourceCollection<LengthAwarePaginator<AnimalResource>>
     *
     * @return AnonymousResourceCollection<LengthAwarePaginator<AnimalResource>>
     */
    public function index(): AnonymousResourceCollection
    {
        return AnimalResource::collection(
            Animal::latest()->paginate()
        );
    }

    /**
     * Store a newly created animal.
     */
    public function store(StoreAnimalRequest $request, StoreAnimalAction $action): AnimalResource
    {
        $animal = $action->execute($request->validated());

        return AnimalResource::make($animal);
    }

    /**
     * Display the specified animal.
     */
    public function show(Animal $animal)
    {
        return AnimalResource::make($animal);
    }

    /**
     * Update the specified animal.
     */
    public function update(UpdateAnimalRequest $request, Animal $animal, StoreAnimalAction $action)
    {
        $animal = $action->on($animal)->execute($request->validated());

        return AnimalResource::make($animal);
    }

    /**
     * Remove the specified animal.
     */
    public function destroy(Animal $animal)
    {
        $animal->delete();

        return response()->noContent();
    }
}
