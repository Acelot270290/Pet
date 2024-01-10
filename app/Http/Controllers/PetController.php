<?php
namespace App\Http\Controllers;

use App\Actions\PetAction;
use App\Http\Requests\PetRequest;
use Illuminate\Http\Request;

class PetController extends Controller
{
    protected $petAction;

    public function __construct(PetAction $petAction)
    {
        $this->petAction = $petAction;
    }

    public function index()
    {
        return response()->json($this->petAction->listUserPets());
    }

    public function store(PetRequest $request)
    {
        $pet = $this->petAction->createPet($request->validated());
        return response()->json($pet, 201);
    }

    public function update(Request $request, $id)
    {
        $updatedPet = $this->petAction->updatePet($id, $request->all());

        if ($updatedPet) {
            return response()->json(['message' => 'Pet updated successfully', 'pet' => $updatedPet]);
        }

        return response()->json(['message' => 'Pet not found or not owned by user'], 404);
    }

    public function destroy($id)
    {
        if ($this->petAction->deletePet($id)) {
            return response()->json(['message' => 'Pet deleted successfully']);
        }

        return response()->json(['message' => 'Pet not found or not owned by user'], 404);
    }
}
