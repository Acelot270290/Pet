<?php
namespace App\Actions;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AppointmentAction
{
    public function createAppointment($data)
    {
        // Se o usuário é um administrador e um 'user_id' é fornecido, use-o.
        // Caso contrário, use o 'user_id' do usuário autenticado.
        if (Auth::user()->cargo_id == 1 && isset($data['user_id'])) {
            $userId = $data['user_id'];
        } else {
            $userId = Auth::id();
        }

        return Appointment::create(array_merge($data, ['user_id' => $userId]));
    }

    public function listUserAppointments()
    {
        // Se o usuário é um administrador, retorna todos os agendamentos.
        // Caso contrário, retorna apenas os agendamentos do usuário autenticado.
        if (Auth::user()->cargo_id == 1) {
            return Appointment::all();
        }

        return Auth::user()->appointments;
    }

    public function updateAppointment($appointmentId, $data)
    {
        if (Auth::user()->cargo_id == 1) {
         
            $appointment = Appointment::find($appointmentId);
        } else {
          
            $appointment = Auth::user()->appointments()->find($appointmentId);
        }

        if (!$appointment) {
            return null;
        }

        $appointment->update($data);
        return $appointment;
    }

    public function deleteAppointment($appointmentId)
    {
        if (Auth::user()->cargo_id == 1) {
            $appointment = Appointment::find($appointmentId);
        } else {
            $appointment = Auth::user()->appointments()->find($appointmentId);
        }

        if ($appointment) {
            $appointment->delete();
            return true;
        }

        return false;
    }
}
