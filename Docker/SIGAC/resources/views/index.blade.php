@extends('templates/site')

@section('conteudo')

    <div class="mt-5 text-center">
        <img src="{{asset('img/ifpr.png')}}" width="256px" height="256px">
        <br><br>
        <span class="fw-light text-success fs-3 mb-3">
            Sistema de Gerenciamento de Atividades Complementares
        </span>
        <hr>
        <table class="table align-middle caption-top table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-success">PAPEL</th>
                    <th scope="col" class="text-success">USUÁRIO</th>
                    <th scope="col" class="text-success">SENHA</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>ADMIN</td><td>admin.admin@ifpr.edu.br</td><td>123admin123</td></tr>
                <tr><td>COORDENADOR</td><td>gil.andrade@ifpr.edu.br</td><td>123gil123</td></tr>
                <tr><td>PROFESSOR</td><td>oriosvaldo.torres@ifpr.edu.br</td><td>123torres123</td></tr>
                <tr><td>ALUNO TADS</td><td>rafaela.amorim@gmail.com</td><td>123rafaela123</td></tr>
                <tr><td>ALUNO INFO</td><td>marina.torres@gmail.com</td><td>123marina123</td></tr>
            </tbody>
        </table>
    </div>

@endsection
