<div>
    @if(count($tabs) == 0)
        <div class="alert alert-success fw-bold">Ainda não há turmas/alunos cadastrados para o curso!!</div>
    @else
        <ul class="nav nav-tabs" id="tab" role="tablist">
            @php 
                $flag = true; 
                $tabs=$tabs->toArray();
            @endphp
            @foreach($tabs as $tab)
                <li class="nav-item" role="presentation">
                    <button 
                        class="nav-link @if($flag) active @endif text-success" 
                        id="{{$tab[$id]}}-tab" 
                        data-bs-toggle="tab" 
                        data-bs-target="#tab-{{$tab[$id]}}" 
                        type="button" 
                        role="tab" 
                        aria-controls="{{$tab[$id]}}" 
                        aria-selected="@if($flag) true @endif"
                    >
                        <b>{{ $tab[$fieldtab] }}</b>
                    </button>
                </li>
                @php $flag = false; @endphp
            @endforeach
        </ul>
        <div class="tab-content" id="tab{{$tab[$id]}}Content">
            @php $flag = true; $cont=1; @endphp
            @foreach($tabs as $tab)
                <div 
                    class="tab-pane fade @if($flag) show active @endif mt-2" 
                    id="tab-{{$tab[$id]}}" 
                    role="tabpanel" 
                    aria-labelledby="{{$tab[$id]}}-tab"
                >
                    @if($contentype == "datatable")
                        <x-datatable 
                            title="" 
                            :header="$header" 
                            :crud="$crud" 
                            :data="$tab[$data]"
                            :fields="$fields" 
                            :hide="$hide"
                            :remove="$fielddata"
                            :create="$create" 
                            id=""
                            :modal="$cont"
                        /> 
                    @elseif($contentype == "listitem") 
                        <x-listitem 
                            :data="$tab[$data]"
                            field="nome"
                            :primaryroute="$primaryroute"
                            :secondaryroute="$secondaryroute"
                            id="{{$tab[$id]}}"
                        />
                    @endif
                </div>
                @php $flag = false; $cont++; @endphp
            @endforeach
        </div>
    @endif
</div>