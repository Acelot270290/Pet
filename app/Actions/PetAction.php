<?php
namespace App\Actions;

use App\Models\Pet;
use Illuminate\Support\Facades\Auth;

class PetAction
{
    public function listUserPets()
    {
        if (Auth::user()->cargo_id == 1) {
            return Pet::all();
        }
    
        return Auth::user()->pets;
    }

    public function createPet($data)
    {
        if (Auth::user()->cargo_id == 1 && isset($data['user_id'])) {
            $userId = $data['user_id'];
        } else {
            $userId = Auth::id();
        }

        return Pet::create([
            'user_id' => $userId,
            'name' => $data['name'],
            'type' => $data['type'],
            'breed' => $data['breed'],
        ]);
    }

    public function deletePet($petId)
    {
        if (Auth::user()->cargo_id == 1) {
           
            $pet = Pet::find($petId);
        } else {
          
            $pet = Auth::user()->pets()->find($petId);
        }
    
        if ($pet) {
            $pet->delete();
            return true;
        }
    
        return false;
    }

    public function updatePet($petId, $data)
    {
        if (Auth::user()->cargo_id == 1) {
            $pet = Pet::find($petId);
        } else {
            $pet = Auth::user()->pets()->find($petId);
        }

        if (!$pet) {
            return null; 
        }

        $pet->update($data);
        return $pet;
    }
}
