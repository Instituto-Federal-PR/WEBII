<html>
    <!-- Não deixou carregar CSS remoto / Verificar posteriormente -->
    <style>
        .cell-header { border-style: solid; border-width: 1px; }
        .font-header { font-size: 14px; font-weight: bold; }
        .xlarge-width { width: 320px; }
        .small-width { width: 90px; }
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
        <h2>Relatório Horas Solicitadas / {{$data['turma']}}</h2>
    </div>
    <div class="div-border">
        <table>
            <thead>
                <tr style="text-align: center;">
                    <th class="cell-header xlarge-width font-header">ALUNO</th>
                    <th class="cell-header small-width font-header">SOLICITADO</th>
                    <th class="cell-header small-width font-header">VALIDADO</th>
                    <th class="cell-header small-width font-header">LANÇADO</th>
                    <th class="cell-header small-width font-header">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['aluno'] as $item)
                    <tr style="text-align: center;"> 
                        <td class="xlarge-width font-content">{{substr($item->nome, 0, 45)}}</td>
                        <td class="small-width font-content">{{$item->solicitado}}</td>
                        <td class="small-width font-content">{{$item->validado}}</td>
                        <td class="small-width font-content">{{$item->lancado}}</td>
                        <td class="small-width font-content">{{$item->validado + $item->lancado}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</html>