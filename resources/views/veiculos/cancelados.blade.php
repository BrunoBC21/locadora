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
            
            @foreach($agendamentoCancelados as $dados)
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('img/veiculos/' . $dados->veiculo->imagem) }}" class="img-fluid rounded-start" alt="Imagem do Veículo">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $dados->veiculo->marca }} - {{ $dados->veiculo->modelo }}</h5>
                                <p class="card-text">
                                    <strong>Cliente:</strong> {{ $dados->user->name }}<br>
                                    <strong>Valor:</strong> {{ $dados->valor }}<br>
                                    <strong>Método de Pagamento:</strong> {{ $dados->pagamento}}<br>
                                    <strong>Data:</strong> {{ $dados->data }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    </div>

@endsection
