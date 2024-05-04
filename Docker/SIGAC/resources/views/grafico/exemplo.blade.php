@extends('templates/main', ['titulo'=>"GŔAFICOS DE EXEMPLO"])

@section('conteudo')

    <div class="row">
        <div class="col text-center" id="barra" style="width: 420px; height: 280px;"></div>
        <div class="col text-center" id="pizza" style="width: 420px; height: 280px;"></div>
    </div>
    <div class="row mt-2">
        <div class="col text-center" id="coluna" style="width: 420px; height: 280px;"></div>
        <div class="col text-center" id="linha" style="width: 420px; height: 280px;"></div>
    </div>
    
@endsection

@section('script')

    <script type="text/javascript">

        var data_graph = <?php echo $data ?>;

        //alert(data)

        google.charts.load('current', {'packages':['corechart']})
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            // Dados do Gráfico    
            let data = google.visualization.arrayToDataTable(data_graph);


            // GRÁFICO DE BARRAS
            // Opções de Configuração
            options = {
                title: 'TOTAL DE HORAS DOS ALUNOS',
                colors: ['#198754'],
                legend: 'none',
                hAxis: {
                    title: 'Horas Validadas',
                    titleTextStyle: {
                        fontSize: 12,
                        bold: true,
                    }
                },
                vAxis: {
                },
            };

            let view = new google.visualization.DataView(data);
            view.setColumns([
                0, 1, { calc: "stringify", sourceColumn: 1, type: "string", role: "annotation" }
            ]);

            // DESENHA GRÁFICO DE BARRAS
            chart = new google.visualization.BarChart(document.getElementById('barra'));
            chart.draw(view, options);

            // ================================================= //

            // GRÁFICO DE PIZZA
            // Opções de Configuração
            options = {
                title: 'TOTAL DE HORAS DOS ALUNOS',
                is3D: true
            };

            // DESENHA GRÁFICO DE PIZZA
            chart = new google.visualization.PieChart(document.getElementById('pizza'));
            chart.draw(data, options);

            // ================================================= //

            // GRÁFICO DE COLUNA
            // Opções de Configuração
            options = {
                title: 'TOTAL DE HORAS DOS ALUNOS',
                colors: ['#198754'],
                legend: 'none',
                role: "annotation",
                hAxis: {
                },
                vAxis: {
                    title: 'Hoas Validadas',
                    titleTextStyle: {
                        fontSize: 12,
                        bold: true,
                    }
                }
            };

            // DESENHA GRÁFICO DE COLUNAS
            chart = new google.visualization.ColumnChart(document.getElementById('coluna'));
            chart.draw(view, options);

            // ================================================= //

            // GRÁFICO DE LINHA
            // Opções de Configuração
            options = {
                title: 'TOTAL DE HORAS DOS ALUNOS',
                colors: ['#198754'],
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            chart = new google.visualization.LineChart(document.getElementById('linha'));
            chart.draw(data, options);
        }

    </script>

@endsection