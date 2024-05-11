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
        </table>
    </div>

@endsection
