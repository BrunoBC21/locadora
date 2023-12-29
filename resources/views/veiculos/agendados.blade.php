@extends('layouts.main')

@section('title', 'veiculos')

@section('content')

    <main>
        <div class="container-fluid">
            <div class="row">
                @if(session('msg'))
                    <p class="msg">{{ session("msg") }}</p>
                @endif
            </div>
        </div>
    </main>

    <div class="container conta">
        
        <section id="veiculos-cadastrados" class="section">
        <h5 style="margin-left: 30%;">Meus agendamentos:</h5>
            @foreach($veiculosAgendados as $dados)
                
                <form action="/cancelar-agendamento" method="post" style="display: inline;">
                    @csrf
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('img/veiculos/' . $dados->veiculo->imagem) }}" class="img-fluid rounded-start" alt="Imagem do Veículo">
                            </div>
                                <div class="col-md-8">
                                <div class="card-body">
                                    <input type="hidden" name="veiculo_id" id="veiculo_id" value="{{$dados->veiculo_id}}">
                                    <input type="hidden" name="data" id="data" value="{{$dados->data}}">
                                    <input type="hidden" name="pagamento" id="pagamento" value="{{$dados->pagamento}}">
                                    <input type="hidden" name="valor" id="valor" value="{{$dados->valor}}">
                                    <input type="hidden" name="id" id="id" value="{{$dados->id}}">
                                    <input type="hidden" name="idUser" id="idUser" value="{{$dados->user_id}}">
                                    
                                <h5 class="card-title">{{ $dados->veiculo->marca }} - {{ $dados->veiculo->modelo }}</h5>
                                <p class="card-text">
                                    @auth
                                        @if(auth()->user()->role === 'admin')
                                            <strong>Cliente:</strong> {{ $dados->user->name }}<br>
                                        @endif
                                    @endauth
                                    <strong>Valor:</strong> {{ $dados->veiculo->preco }}<br>
                                    <strong>Método de Pagamento:</strong> {{ $dados->pagamento}}<br>
                                    <strong>Data:</strong> {{ $dados->data }}
                                    <button type="submit" class="btn btn-danger" style="margin-left: 70%">Cancelar</button>
                                </p>
    
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                </form>
            @endforeach
        </section>
    </div>

@endsection
