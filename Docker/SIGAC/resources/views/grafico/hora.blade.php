@extends('templates/main', ['titulo'=>"GRÁFICO DE HORAS / TURMAS"])

@section('conteudo')
    <div class="d-flex flex-row">
        @foreach($data as $item) 
            <div class="form-check form-check-inline">
                <input
                    class="btn-check"
                    type="radio"
                    name="turma"
                    id="turma_{{$item['turma']}}"
                    value="{{$item['turma']}}"
                    onclick="selectClass({{$item}})"
                />
                <label class="btn btn-outline-success" for="turma_{{$item['turma']}}">{{ $item['turma'] }}</label>
            </div>
        @endforeach
    </div>
    <hr>
    <div class="row overflow-auto mt-2">
        <div class="col text-center" id="pizza" style="width: 480px; height: 360px;"></div>
    </div>
    
@endsection

@section('script')

    <script type="text/javascript">

        function selectClass(turma) {

            let cont = 1
            let data_graph = [
                ['Validaram', 'NÃO Validaram'],
                ['CUMPRIRAM', turma.grafico.total_sim],
                ['NÃO CUMPRIRAM',  turma.grafico.total_nao],
            ]

            google.charts.load('current', {'packages':['corechart']})
            google.charts.setOnLoadCallback(drawChart(data_graph));
        }

        function drawChart(data_graph) {

            let data = google.visualization.arrayToDataTable(data_graph);

            // Opções de Configuração
            options = {
                title: 'PERCENTUAL DE ALUNOS QUE JÁ CUMPRIRAM OU NÃO AS HORAS AFINS',
                is3D: true
            };

            // DESENHA GRÁFICO DE BARRAS
            chart = new google.visualization.PieChart(document.getElementById('pizza'));
            chart.draw(data, options);
        }

    </script>

@endsection