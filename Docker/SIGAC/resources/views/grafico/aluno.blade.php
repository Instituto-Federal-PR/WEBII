@extends('templates/main', ['titulo'=>"GRÁFICO DE HORAS / TURMA"])

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
        <div class="col text-center" id="barra" style="width: 480px; height: 360px;"></div>
    </div>
    
@endsection


@section('script')

    <script type="text/javascript">

        var data_graph = [
            ['Aluno', 'Solicitado', 'Lançado', 'Validado', { role: 'annotation' }]
        ]

        function selectClass(turma) {
            
            let cont = 1

            // alert(turma.aluno[0].nome)
            turma.aluno.forEach((element) => {
                data_graph[cont] = [
                    element.nome,
                    element.solicitado,
                    element.lancado,
                    element.validado + element.lancado,
                    ''
                ]
                cont++ 
            })

            /*data_graph = [
                ['Aluno', 'Solicitado', 'Lançado', 'Validado', { role: 'annotation' } ],
                ['2010', 10, 24, 20, ''],
                ['2020', 16, 22, 23, ''],
                ['2030', 28, 19, 29, '']
            ];*/

            // alert(turma.aluno[0].nome)
            google.charts.load('current', {'packages':['corechart']})
            google.charts.setOnLoadCallback(drawChart); 
        }

        function drawChart() {

            let data = google.visualization.arrayToDataTable(data_graph);

            // Opções de Configuração
            let options = {
                title: 'TOTAL DE HORAS DOS ALUNOS',
                legend: { position: 'top', maxLines: 3 },
                isStacked: true,
                hAxis: {
                    title: 'Horas Validadas',
                    titleTextStyle: {
                        fontSize: 12,
                        bold: true,
                    },
                    textPosition: 'none'
                },
                vAxis: {
                },
            };

            // RÓTULOS
            let view = new google.visualization.DataView(data);
            view.setColumns([
                0,
                1,
                { calc: "stringify", sourceColumn: 1, type: "string", role: "annotation" },
                2, 
                { calc: "stringify", sourceColumn: 2, type: "string", role: "annotation" },
                3,
                { calc: "stringify", sourceColumn: 3, type: "string", role: "annotation" },
            ]);

            // DESENHA GRÁFICO DE BARRAS
            chart = new google.visualization.BarChart(document.getElementById('barra'));
            chart.draw(view, options);
        }

    </script>

@endsection