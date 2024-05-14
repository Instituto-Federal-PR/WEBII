<div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            @if($data instanceof \Illuminate\Pagination\AbstractPaginator )
                {{ $data->links() }}
            @endif
        </div>
    </div>
    
    <table class="table align-middle table-striped">
        <tbody>
            @foreach ($data as $item)
                <form action="{{ route('assess.finish', $item->id) }}" method="POST" id="form_{{$item->id}}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status_{{$item->id}}" id="status_{{$item->id}}">
                    <input type="hidden" name="comment_{{$item->id}}" id="comment_{{$item->id}}">
                    <tr>
                        <td>
                            <a href="{{asset('storage/'.$item->url)}}" target="_blank" class="ms-2" style="text-decoration: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#198754" class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                                    <path d="M5.523 12.424q.21-.124.459-.238a8 8 0 0 1-.45.606c-.28.337-.498.516-.635.572l-.035.012a.3.3 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548m2.455-1.647q-.178.037-.356.078a21 21 0 0 0 .5-1.05 12 12 0 0 0 .51.858q-.326.048-.654.114m2.525.939a4 4 0 0 1-.435-.41q.344.007.612.054c.317.057.466.147.518.209a.1.1 0 0 1 .026.064.44.44 0 0 1-.06.2.3.3 0 0 1-.094.124.1.1 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256M8.278 6.97c-.04.244-.108.524-.2.829a5 5 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.5.5 0 0 1 .145-.04c.013.03.028.092.032.198q.008.183-.038.465z"/>
                                    <path fill-rule="evenodd" d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.7 11.7 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.86.86 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.84.84 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.8 5.8 0 0 0-1.335-.05 11 11 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.24 1.24 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a20 20 0 0 1-1.062 2.227 7.7 7.7 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103"/>
                                </svg>
                            </a>
                        </td>
                        <td>
                            <span class="fs-6 ms-3 fw-bold text-success d-none d-md-table-cell">
                                {{Date_format($item->created_at, "d/m/Y")}}
                            </span>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <span class="input-group-text fs-6 fw-normal bg-success text-white" style="min-width: 30px;">{{$item->horas_in}}</span>
                                <span class="input-group-text fs-6 fw-normal bg-success text-white" style="min-width: 30px;">hora(s)</span>
                                <input 
                                    type="number" 
                                    name="horas_out_{{$item->id}}"
                                    id="horas_out_{{$item->id}}"
                                    class="form-control text-success fw-bold" 
                                    value="{{$item->horas_in}}" 
                                    min="1"
                                    max="{{$item->horas_in}}" 
                                    style="max-width: 80px;" 
                                    onKeypress="event.preventDefault();"
                                />
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-success d-none d-md-table-cell" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_{{$item->id}}" aria-controls="offcanvas_{{$item->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                </svg>
                                <span class="ms-2">Mais</span>
                            </button>
                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas_{{$item->id}}" aria-labelledby="offcanvasRightLabel">
                                <div class="offcanvas-header  bg-success">
                                    <h5 class="offcanvas-title text-white" id="offcanvasRightLabel">{{$item->user->name}}</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    
                                        <table class="table align-middle table-striped">
                                            <tbody>
                                                <tr><td>{{ $item->descricao }}</td></tr>
                                                <tr><td>{{ $item->categoria->nome }}</td></tr>
                                            </tbody>
                                        </table>
                                    
                                </div>
                            </div>
                        </td>
                        <td>
                            <a nohref style="cursor:pointer" onclick="showConfirmModal('{{$item->id}}', true)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#198754" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>
                            </a>
                            <a nohref style="cursor:pointer" onclick="showConfirmModal('{{$item->id}}', false)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#dc3545" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                </svg>
                            </a>    
                        </td>
                    </tr>
                </form>
            @endforeach    
        </tbody>
    </table>

    <div class="modal fade" tabindex="-1" id="confirmModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal">CONFIRMAÇÃO: AVALIAÇÃO HORAS AFINS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="confirmModal" onclick="closeConfirmModal()" aria-label="Close"></button>
                </div>
                <input type="hidden" name="id" id="id">
                <div class="modal-body text-secondary">
                    <div class="form-group">
                        <label for="comentario">Comentário</label>
                        <textarea class="form-control" name="comentario" id="comentario" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-block align-content-center" onclick="closeConfirmModal()">
                        Não
                    </button>
                    <button type="button" id="button_y" onclick="confirm()">
                        Sim
                    </button>
                </div>
            </div>
        </div>
    </div>
    

    <script type="text/javascript">

        // FUNÇÕES - MODAL DE REMOÇÃO //
        function showConfirmModal(id, response) {

            let input_status = '#status_' + id
            let input_comment = '#comment_' + id

            $('#id').val(id)
            $('#confirmModal').modal().find('.modal-title').html("")
            $("#comentario").html("");
            $("#title_modal").removeClass();
            $("#button_y").removeClass();
            $("#comentario").removeClass();

            if(response) {
                $(input_status).val(1)
                $(input_comment).val('DEFERIDO')
                $('#comentario').val('DEFERIDO')
                $('#title_modal').addClass("modal-title text-success")
                $('#confirmModal').modal().find('.modal-title').append("CONFIRMAR DEFERIMENTO DO PEDIDO?")
                $('#button_y').addClass("btn btn-success")
                $("#comentario").addClass("form-control fw-bold text-success ")
                $("#comentario").append("DEFERIDO")
            }
            else {
                $(input_status).val(-1)
                $(input_comment).val('INDEFERIDO')
                $('#comentario').val('INDEFERIDO')
                $('#title_modal').addClass("modal-title text-danger")
                $('#confirmModal').modal().find('.modal-title').append("CONFIRMAR INDEFERIMENTO DO PEDIDO?")
                $('#button_y').addClass("btn btn-danger")
                $("#comentario").addClass("form-control fw-bold text-danger")
                $("#comentario").append("INDEFERIDO")
            }
            
            $('#confirmModal').modal('show')
        }

        function closeConfirmModal(modal) { 
            $('#confirmModal').modal('hide')
        }

        function confirm() {
            let form = "form_" + $('#id').val()
            document.getElementById(form).submit()
            $('#confirmModal').modal('hide')
        }
    </script>

</div>