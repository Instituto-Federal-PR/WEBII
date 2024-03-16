<div>
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
                    {{ $tab[$fieldtab] }}
                </button>
            </li>
            @php $flag = false; @endphp
        @endforeach
    </ul>
    <div class="tab-content" id="tab{{$tab[$id]}}Content">
        @php $flag = true; @endphp
        @foreach($tabs as $tab)
            <div 
                class="tab-pane fade @if($flag) show active @endif mt-2" 
                id="tab-{{$tab[$id]}}" 
                role="tabpanel" 
                aria-labelledby="{{$tab[$id]}}-tab"
            >
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
                /> 
            </div>
            @php $flag = false; @endphp
        @endforeach
    </div>
</div>


<!--
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
  </div>

-->