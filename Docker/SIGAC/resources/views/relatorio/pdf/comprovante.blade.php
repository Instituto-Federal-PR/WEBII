<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprovante de Conclusão - Horas Complementares</title>
</head>
<body>
    <div style="width: 20%; float:left">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/ifpr.png'))) }}" width="120" height="120">
    </div>
    <div style="width: 80%; float:right">
        <h1 style="text-align: center;">SIGAC</h1>
        <h3 style="text-align: center;">Sitema de Gerenciamento de Atividades Complementares</h3>
    </div>    
    <br><br><br><br><br><br><hr>
    <div style="text-align: center;">
        <h1>CERTIFICADO DE CONCLUSÃO</h1>
        <h3>HORAS COMPLEMENTARES</h3>
    </div>
    <hr>
    <br><br>
    <p style="text-align: justify; font-size:20px";>
        Certifica-se, aos devidos fins, que o(a) aluno(a) <b>{{$data->nome}}</b>, CPF <b>{{$data->cpf}}</b>, 
        graduando(a) do curso <b>{{$data->curso}}</b>, apresentou a documentação que <b>comprova</b> a execução de 
        <b>{{ $data->horas_cumpridas }} horas</b> de atividades complementares, de um total exigido 
        de <b>{{ $data->horas_necessarias }} horas</b>.
    </p>
    <br><br><br><br><br><br><br><br><br><br>
    <p style="text-align: left; font-size:20px";>
        Paranaguá, {{$data->dia}} de {{$data->mes}} de {{$data->ano}}.
    </p>
    <br><br><br><br><br><br>
    <div style="text-align: center;">
        <p style="font-size:18px; color:darkred; font-weight: bold";>{{$data->hash}}</p>
    </div>
    <hr width="400px">
    <p style="text-align: center; font-size:18px";>
        <b>SIGAC - Sistema de Gerenciamento de Horas Complementares.</b>
    </p>
    
</body>
</html>