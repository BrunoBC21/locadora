<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Cancelar;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class CarController extends Controller
{
    public function store(Request $request) {
  
        $placaExistente = Veiculo::where('placa', $request->placa)->exists();
    
        if ($placaExistente) {
            return redirect('/cadastrar-veiculo')->with("msg", "Esta placa pertence à outro Veículo. Por favor, insira uma placa válida.");
        }
        $carro = new Veiculo;
        $carro->marca = $request->marca;
        $carro->modelo = $request->modelo;
        $carro->placa = $request->placa;
        $carro->ano_fabricacao = $request->ano_fabricacao;
        $carro->preco = $request->preco;
    
        $requestImage = $request->image;
        $extension = $requestImage->extension();
    
        $imageName = md5($requestImage->getClientOriginalName() . strtotime("now") . '.' . $extension);
    
        $requestImage->move(public_path("img/veiculos"), $imageName);
        $carro->imagem = $imageName;
    
        $carro->save();
    
        return redirect('/')->with("msg", "Sucesso ao cadastrar o veículo!");
    }
    

    public function mostrarCarro() {
        $veiculos = Veiculo::all();
        return view("Welcome",["veiculos"=>$veiculos]);

    }

    public function mostrarFormularioCadastro(){
        return view("veiculos/create");
    }
    
    public function diasDisponiveis($veiculoId){

        $veiculo = Veiculo::findOrFail($veiculoId);
        $diasIndisponiveis = DB::table('reservas')
        ->where('veiculo_id', $veiculoId)
        ->pluck('data');

        $veiculo = Veiculo::find($veiculoId);
        return view('veiculos/agendamento', ['diasIndisponiveis' => $diasIndisponiveis,'veiculo' => $veiculo,]);
    }
    public function deletarVeiculo(Request $request){
        $apagar = Veiculo::find($request->id);
        $apagar->delete();
    

        return redirect("/")->with("msg", "Veículo apagado com sucesso");
    }
}
