<h1>Relatorio de Eixos</h1>
<hr>
<ul>
    @foreach ($data as $item)
        <li>{{$item->nome}}</li>
    @endforeach
</ul>