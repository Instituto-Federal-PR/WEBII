<html>
    <body>
        <h4>Prezado coordenador,<br>{{ $data->coordenador }}</h4>
        <br>
        <p> Uma nova solicitação de horas complementares foi efetuada no Sistema de Gerenciamento de Atividades Complementares - SIGAC.</p>
        <br>
        <p> <b>Aluno:</b> {{ $data->aluno }}</p>
        <p> <b>Curso:</b> {{ $data->curso }}</p>
        <p> <b>Turma:</b> {{ $data->turma }}</p>
        <p> <b>Categoria:</b> {{ $data->categoria }}</p>
        <p> <b>Atividade:</b> {{ $data->atividade }}</p>
        <p> <b>Horas:</b> {{ $data->horas }}</p>
        <br>
        <div>
            <img width="40%" height="80%" src="{{ $message->embed(public_path().'/img/ifpr.png') }}">
        </div>
    </body>
</html>