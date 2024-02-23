<div>
    <div class="row">
        <div class="col" >
            <div class="form-floating mb-3">
                <input
                    type="{{$type}}"
                    class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
                    name="{{ $name }}"
                    placeholder="Número"
                    value="{{old($name)}}"
                />
                @if($errors->has($name))
                    <div class='invalid-feedback'>
                        {{ $errors->first($name) }}
                    </div>
                @endif
                <label for="cep">{{$label}}</label>
            </div>
        </div>
    </div>
</div>