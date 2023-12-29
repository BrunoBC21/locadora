@extends('layouts.main')

@section('title', 'criando um novo veículo')

@section("content")
<main>
    <div class="container-fluid">
        <div class="row">
            @if(session('msg'))
                <p class="error">{{session("msg")}}</p>
            @endif
        </div>
    </div>
</main>

<div class="container">
    <section id="cadastro-veiculo" class="section">
        <h2>Cadastro de Veículo</h2>

        <form action="/cadastrar-veiculo" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="image" class="form-label">Imagem do Carro</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>

            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" required>
            </div>

            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" required>
            </div>

            <div class="mb-3">
                <label for="placa" class="form-label">Placa</label>
                <input type="text" class="form-control" id="placa" name="placa" required>
                @error('placa')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="ano_fabricacao" class="form-label">Ano de Fabricação</label>
                <input type="text" class="form-control" id="ano_fabricacao" name="ano_fabricacao" required>
            </div>

            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="text" class="form-control" id="preco" name="preco" required>
            </div>

            <button type="submit" class="custom-btn">Cadastrar</button>
        </form>
    </section>
</div>

@endsection
