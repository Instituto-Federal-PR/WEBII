<div>
    @if(count($data) > 0)
        <span class="fw-bold text-center ms-2 text-secondary">{{ mb_strtoupper($title, 'UTF-8'); }}</span>
    @endif
    <ul class="list-group">
        @foreach ($data as $item)
            <li class="list-group-item disabled">{{ $item->$field }}</li>
        @endforeach
    </ul>
</div>