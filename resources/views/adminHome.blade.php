@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Estadísticas rápidas --}}
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Total de Eventos</h5>
                    <h3>{{ $totalEventos }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Total de Participantes</h5>
                    <h3>{{ $totalParticipantes }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Total de Inscripciones</h5>
                    <h3>{{ $totalInscripciones }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Gráficos --}}
    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-center fw-bold">
                    Eventos por Tipo
                </div>
                <div class="card-body">
                    <canvas id="eventosPie" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-center fw-bold">
                    Inscripciones por Mes
                </div>
                <div class="card-body">
                    <canvas id="inscripcionesBar" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Eventos recientes --}}
    <div class="card shadow">
        <div class="card-header fw-bold">
            Últimos Eventos Creados
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eventosRecientes as $evento)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $evento->titulo }}</td>
                            <td>{{ ucfirst($evento->tipo) }}</td>
                            <td>{{ $evento->fecha }}</td>
                            <td>{{ ucfirst($evento->estado) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Chart(document.getElementById('eventosPie'), {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_keys($eventosPorTipo)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($eventosPorTipo)) !!},
                    backgroundColor: ['#28a745', '#17a2b8', '#ffc107', '#dc3545', '#6610f2'],
                }]
            }
        });

        new Chart(document.getElementById('inscripcionesBar'), {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($inscripcionesPorMes)) !!},
                datasets: [{
                    label: 'Inscripciones',
                    data: {!! json_encode(array_values($inscripcionesPorMes)) !!},
                    backgroundColor: '#17a2b8',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });
    });
</script>
@endsection
