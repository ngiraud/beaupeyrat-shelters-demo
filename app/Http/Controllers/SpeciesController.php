<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpeciesRequest;
use App\Http\Requests\UpdateSpeciesRequest;
use App\Http\Resources\SpeciesResource;
use App\Models\Species;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SpeciesController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the species.
     *
     * @response AnonymousResourceCollection<LengthAwarePaginator<SpeciesResource>>
     *
     * @return AnonymousResourceCollection<LengthAwarePaginator<SpeciesResource>>
     */
    public function index()
    {
        return SpeciesResource::collection(
            Species::orderby('name')->paginate()
        );
    }

    /**
     * Store a newly created species.
     */
    public function store(StoreSpeciesRequest $request)
    {
        $this->authorize('create', Species::class);

        $species = Species::create($request->validated());

        return SpeciesResource::make($species);
    }

    /**
     * Display the specified species.
     */
    public function show(Species $species)
    {
        return SpeciesResource::make($species);
    }

    /**
     * Update the specified species.
     */
    public function update(UpdateSpeciesRequest $request, Species $species)
    {
        $species->update($request->validated());

        return SpeciesResource::make($species);
    }

    /**
     * Remove the specified species.
     */
    public function destroy(Species $species)
    {
        $species->animals()->update([
            'species_id' => Species::where('name', 'Uncategorized')->value('id'),
        ]);

        $species->delete();

        return response()->noContent();
    }
}
