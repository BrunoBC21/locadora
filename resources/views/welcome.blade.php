@extends('layouts.main')

@section('title', 'veiculos')

@section('content')

<main>
    <div class="container-fluid">
        <div class="row">
            @if(session('msg'))
                <p class="msg">{{session("msg")}}</p>
            @endif
        </div>
    </div>
</main>

<div class="container conta">
    <section id="veiculos-cadastrados" class="section">
        @foreach($veiculos as $veiculo)
            <form action="/deletar-veiculo" method="post">
                @csrf
                <div class="card mb-3" style="max-width: 540px;">
                    <a href="{{ url('/dias-disponiveis', $veiculo->id) }}" class="text-decoration-none text-dark">
                        <div class="row g-0">
                            <div div class="col-md-4">
                                <img src="{{ asset('img/veiculos/' . $veiculo->imagem) }}" class="img-fluid rounded-start" alt="Imagem do Veículo">
                            </div>
                            <div class="col-md-8">
                                <div div class="card-body">
                                    <h5 class="card-title">{{ $veiculo->marca }} - {{ $veiculo->modelo }}</h5>
                                        <p class="card-text">
                                            <strong>Placa:</strong> {{ $veiculo->placa }}<br>
                                             <strong>Ano de Fabricação:</strong> {{ $veiculo->ano_fabricacao }}<br>
                                             <strong>Preço por dia:</strong> {{ $veiculo->preco}}
                                             @auth
                                                @if(auth()->user()->role === 'admin')
                                                    <button type="submit" class="btn btn-danger" style="margin-left: 76%">Deletar</button>
                                                @endif
                                            @endauth
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <input type="hidden" name="id" id="id" value="{{$veiculo->id}}">
                    </div> 
                  </form>
                @endforeach
    </section>
</div>

@endsection
