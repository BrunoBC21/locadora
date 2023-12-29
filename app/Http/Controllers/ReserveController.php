<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use Carbon\Carbon;

class ReserveController extends Controller
{
    public function agendamento(Request $request) {

            $agendamento = new Reserva;
            $agendamento->data =$request->selectedDay;
            $agendamento->pagamento= $request->metodo_pagamento;
            $agendamento->veiculo_id = $request->veiculo_id;
            $agendamento->user_id = auth()->user()->id;
            $agendamento->save();

     return redirect("/meus-agendamentos")->with("msg","Sucesso ao agendar!");
        
    }
    public function meusAgendamentos(){
        $user = auth()->user();

        if ($user->role === 'admin') {
            $veiculosAgendados = Reserva::with(['Veiculo', 'User'])->get();

        } elseif ($user->role === 'user') {

            $veiculosAgendados = Reserva::with(['Veiculo', 'User'])
                ->where('user_id', $user->id)
                ->get();
        }
        return view("/veiculos/agendados", ["veiculosAgendados"=>$veiculosAgendados]);
    }
}
