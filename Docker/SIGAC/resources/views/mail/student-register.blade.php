<html>
    <body>
        <h4>Prezado coordenador,<br>{{ $data->coordenador }}</h4>
        <br>
        <p> Um novo registro de aluno foi efetuado no Sistema de Gerenciamento de Atividades Complementares - SIGAC.</p>
        <br>
        <p> <b>Aluno:</b> {{ $data->aluno }}</p>
        <p> <b>Curso:</b> {{ $data->curso }}</p>
        <p> <b>Turma:</b> {{ $data->turma }}</p>
        <br>
        <div>
            <img width="40%" height="80%" src="{{ $message->embed(public_path().'/img/ifpr.png') }}">
        </div>
    </body>
</html>