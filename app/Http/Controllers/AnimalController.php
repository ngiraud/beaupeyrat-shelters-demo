<?php

namespace App\Http\Controllers;

use App\Actions\Animal\StoreAnimalAction;
use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;
use App\Http\Resources\AnimalResource;
use App\Models\Animal;
use Illuminate\Http\Request;
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
    public function index(Request $request): AnonymousResourceCollection
    {
        return AnimalResource::collection(
            $request->user()->shelter->animals()->latest()->paginate()
        );
    }

    /**
     * Store a newly created animal.
     */
    public function store(StoreAnimalRequest $request, StoreAnimalAction $action): AnimalResource
    {
        $animal = $action->onShelter($request->user()->shelter)
            ->execute($request->validated());

        return AnimalResource::make($animal);
    }

    /**
     * Display the specified animal.
     */
    public function show(Animal $animal)
    {
        $this->authorize('view', $animal);

        return AnimalResource::make($animal);
    }

    /**
     * Update the specified animal.
     */
    public function update(UpdateAnimalRequest $request, Animal $animal, StoreAnimalAction $action)
    {
        $this->authorize('update', $animal);

        $animal = $action->onShelter($request->user()->shelter)
            ->onAnimal($animal)
            ->execute($request->validated());

        return AnimalResource::make($animal);
    }

    /**
     * Remove the specified animal.
     */
    public function destroy(Animal $animal)
    {
        $this->authorize('delete', $animal);

        $animal->delete();

        return response()->noContent();
    }
}
