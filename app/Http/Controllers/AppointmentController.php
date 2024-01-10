<?php

namespace App\Http\Controllers;

use App\Actions\AppointmentAction;
use App\Http\Requests\AppointmentRequest;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected $appointmentAction;

    public function __construct(AppointmentAction $appointmentAction)
    {
        $this->appointmentAction = $appointmentAction;
    }

    public function index()
    {
        return response()->json($this->appointmentAction->listUserAppointments());
    }

    public function store(AppointmentRequest $request)
    {
        $appointment = $this->appointmentAction->createAppointment($request->validated());
        return response()->json($appointment, 201);
    }

    public function update(AppointmentRequest $request, $id)
    {
        $updatedAppointment = $this->appointmentAction->updateAppointment($id, $request->validated());

        if ($updatedAppointment) {
            return response()->json(['message' => 'Appointment updated successfully', 'appointment' => $updatedAppointment]);
        }

        return response()->json(['message' => 'Appointment not found or not owned by user'], 404);
    }

    public function destroy($id)
    {
        if ($this->appointmentAction->deleteAppointment($id)) {
            return response()->json(['message' => 'Appointment deleted successfully']);
        }

        return response()->json(['message' => 'Appointment not found or not owned by user'], 404);
    }
}
