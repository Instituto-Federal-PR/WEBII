<html>

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
                    <th style="width: 450px; border-style: solid; border-width: 1px;">ALUNO</th>
                    <th style="width: 115px; border-style: solid; border-width: 1px;">SOLICITADO (horas)</th>
                    <th style="width: 115px; border-style: solid; border-width: 1px;">VALIDADO (horas)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['aluno'] as $item)
                    <tr style="text-align: center;"> 
                        <td style="width: 450px;">{{substr($item->nome, 0, 35)}}</td>
                        <td style="width: 90px;">{{$item->solicitado}}</td>
                        <td style="width: 140px;">{{$item->validado}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</html>