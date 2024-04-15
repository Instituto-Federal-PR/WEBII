<html>
    <!-- Não deixou carregar CSS remoto / Verificar posteriormente -->
    <style>
        .cell-header { border-style: solid; border-width: 1px; }
        .font-header { font-size: 14px; font-weight: bold; }
        .xlarge-width { width: 350px; }
        .large-width { width: 300px; }
        .medium-width { width: 110px; }
        .small-width { width: 80px; }
        .font-content { font-size: 12px; }    
    </style>

    <div style="width: 20%; float:left">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/ifpr.png'))) }}" width="120" height="120">
    </div>
    <div style="width: 80%; float:right">
        <h1 style="text-align: center;">SIGAC</h1>
        <h3 style="text-align: center;">Sitema de Gerenciamento de Atividades Complementares</h3>
    </div>    
    <br><br><br><br><br><br><hr>
    <div style="text-align: center;">
        <h2>Relatório Horas Solicitadas</h2>
        <h3>{{substr($data['aluno'], 0, 50)}} / {{$data['total']}} HORAS</h3>
    </div>
    <hr>
    <span class="font-header">SOLICITAÇÕES DO ALUNO</span>
    <div class="div-border">
        <table>
            <thead>
                <tr style="text-align: center;">
                    <th class="cell-header xlarge-width font-header">DESCRIÇÃO</th>
                    <th class="cell-header medium-width font-header">SOLICITADO</th>
                    <th class="cell-header medium-width font-header">STATUS</th>
                    <th class="cell-header medium-width font-header">VALIDADO</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['pedidos'] as $item)
                    <tr style="text-align: center;"> 
                        <td class="xlarge-width font-content">{{substr($item->descricao, 0, 50)}}</td>
                        <td class="medium-width font-content">{{$item->horas_in}}</td>
                        <td class="medium-width font-content">{{$item->status}}</td>
                        <td class="medium-width font-content">{{$item->horas_out}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <span class="font-header">LANÇAMENTOS DOS SERVIDORES</span>
    <div class="div-border">
        <table>
            <thead>
                <tr style="text-align: center;">
                    <th class="cell-header font-header large-width">DESCRIÇÃO</th>
                    <th class="cell-header font-header large-width">SERVIDOR</th>
                    <th class="cell-header font-header small-width">HORAS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['lancados'] as $item)
                    <tr style="text-align: center;"> 
                        <td class="font-content large-width">{{substr($item->nome, 0, 50)}}</td>
                        <td class="font-content large-width">{{substr($item->servidor, 0, 50)}}</td>
                        <td class="font-content large-small">{{$item->horas}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</html>