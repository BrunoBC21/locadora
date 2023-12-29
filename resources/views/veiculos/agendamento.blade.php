@extends('layouts.main')

@section('title', 'Agendamento')

@section("content")

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pikaday@1.8.0/css/pikaday.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<div class="container mt-5">
    <form id="agendamento" action="/agendamento" method="post" required>
        @csrf
        <input type="hidden" id="veiculo_id" name="veiculo_id" value="{{$veiculo->id}}">
        <div class="mb-3">
            <label for="selectedVehicle" class="form-label">Veículo Selecionado:</label>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('img/veiculos/' . $veiculo->imagem) }}" class="img-fluid rounded-start"
                            alt="Imagem do Veículo">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $veiculo->marca }} - {{ $veiculo->modelo }}</h5>
                            <p class="card-text">
                                <strong>Placa:</strong> {{ $veiculo->placa }}<br>
                                <strong>Ano de Fabricação:</strong> {{ $veiculo->ano_fabricacao }}<br>
                                <strong>Preço por dia: :</strong> {{ $veiculo->preco }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <h2>Calendário Semanal</h2>

            <div class="calendar-row">
                @php
                    $currentDate = new DateTime();
                    $currentDate->setTime(0, 0, 0);
                    $diasSemana = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
                @endphp

                @for ($i = 0; $i < 7; $i++)
                    @php
                        $day = clone $currentDate;
                        $day->modify('+' . $i . ' day');
                        $formattedDay = $day->format('Y-m-d'); // Formatando no mesmo formato do array
                        $diaSemana = $diasSemana[$day->format('w')];
                    @endphp

                    <div class="calendar-day {{ $diasIndisponiveis->contains($formattedDay) ? 'unavailable' : '' }}"
                        data-date="{{ $formattedDay }}">
                        <div class="day-week">{{ $diaSemana }}</div>
                        <div class="day-number">{{ $day->format('j') }}</div>
                    </div>
                @endfor
            </div>


            <input type="hidden" name="selectedDay" id="selectedDayInput" value="" required>

            <div class="mb-3">
                <label class="form-label"><h4>Métodos de Pagamento:</h4></label>

                <select name="metodo_pagamento" id="metodo_pagamento" class="form-select">
                    <option value="Cartão de Crédito">
                        Cartão de Crédito
                    </option>

                    <option value="Boleto Bancário">
                        Boleto Bancário
                    </option>

                    <option value="Pix">
                        PIX
                    </option>
                </select>

            </div>
            <button type="button" class="custom-btn " id="btnAgendar">Agendar</button>
        </form>

    </div>

    <script>
        $(document).ready(function () {
            var selectedDay = null;

            $(".calendar-day").on("click", function () {
                var formattedDay = $(this).data('date');

                if (formattedDay === selectedDay) {
                    selectedDay = null;
                    $(this).removeClass("selected");
                } else {
                    selectedDay = formattedDay;
                    $(".calendar-day").removeClass("selected");
                    $(this).addClass("selected");
                }
                $("#selectedDayInput").val(selectedDay);

                console.log("Dia selecionado:", selectedDay);
            });

            $("#btnAgendar").on("click", function () {
                if (selectedDay !== null) {
                    console.log("Dia selecionado formatado:", selectedDay);
                    $("#agendamento").submit();
                } else {
                    alert("Selecione um dia disponível antes de agendar.");
                }
            });
        });
    </script>

    @endsection
