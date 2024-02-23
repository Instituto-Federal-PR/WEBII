<div>
    <div class="row">
        <div class="col" >
            <div class="input-group mb-3">
                <span class="input-group-text bg-{{$color}} text-white">{{$label}}</span>
                <select 
                    name="{{$name}}"
                    class="form-select"
                    class="form-control @if($errors->has($name)) is-invalid @endif" 
                >
                    @foreach ($data as $item)
                        <option value="{{$item->id}}" @if($item->id == old($name)) selected="true" @endif>
                            {{ $item->nome }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has($name))
                    <div class='invalid-feedback'>
                        {{ $errors->first($name) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>