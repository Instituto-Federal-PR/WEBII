<div>
    @if($type == "submit")
        <button type="submit" class="btn btn-{{$color}} btn-block align-content-center">
            <span class="fw-bold">{{$label}}</span> &nbsp;
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
        </button>
    @elseif($type == "link")
        <a href="{{route($route)}}" class="btn btn-{{$color}} btn-block align-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-link" viewBox="0 0 16 16">
                <path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9q-.13 0-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/>
                <path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4 4 0 0 1-.82 1H12a3 3 0 1 0 0-6z"/>
            </svg>
            &nbsp; <span class="fw-bold">{{$label}}</span>
        </a>
    @else 
        <a href="{{route($route)}}" class="btn btn-{{$color}} btn-block align-content-center">
            <span class="fw-bold">{{$label}}</span>
        </a>
    </a>
    @endif
</div>