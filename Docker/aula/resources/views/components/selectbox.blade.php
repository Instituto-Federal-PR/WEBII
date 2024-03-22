<div>
    <div class="row">
        <div class="col" >
            <div class="input-group mb-3">
                <span class="input-group-text bg-{{$color}} text-white">{{$label}}</span>
                <select 
                    name="{{$name}}"
                    id="{{$name}}"
                    class="form-select"
                    class="form-control @if($errors->has($name)) is-invalid @endif" 
                    @if($disabled == "true") disabled @endif 
                >
                    <option selected="true" disabled></option>
                    @foreach ($data as $item)
                        <option value="{{$item->id}}" @if($item->id == $select) selected="true" @endif>
                            {{ $item->$field }}
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