<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Cancelar;

class CancelarController extends Controller
{
    public function cancelarAgendamento(Request $request) {

            $reservaCancelada = new Cancelar;
            $reservaCancelada->veiculo_id = $request->veiculo_id;
            $reservaCancelada->user_id = $request->idUser;
            $reservaCancelada->data = $request->data;
            $reservaCancelada->pagamento = $request->pagamento;
    
            $reservaCancelada->save();
            $modelo = Reserva::find($request->id);
            $modelo->delete();
       
            return redirect('/')->with("msg","Sucesso ao cancelar!");
    }
    public function mostrarCancelados(){
        $agendamentoCancelados = Cancelar::all();
        return view("/veiculos/cancelados", ["agendamentoCancelados"=>$agendamentoCancelados]);
    }
}
