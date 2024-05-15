@extends('templates/main', ['titulo'=>"VALIDAÇÃO - CADASTRO DE ALUNOS"])

@section('conteudo')

    @if(count($data) > 0)
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
                    <form action="{{ route('validate.finish', $item->id) }}" method="POST" id="form_{{$item->id}}">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="status_{{$item->id}}" id="status_{{$item->id}}">
                        <tr>
                            <td>{{$item->nome}}</td>
                            <td class="d-none d-md-table-cell">{{$item->curso->sigla}}-{{$item->turma->ano}}</td>
                            <td>
                                <a nohref style="cursor:pointer" onclick="showConfirmModal('{{$item->id}}', '{{$item->nome}}', true)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#198754" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                </a>
                                <a nohref style="cursor:pointer" onclick="showConfirmModal('{{$item->id}}', '{{$item->nome}}', false)">
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
    @else
        <div class="alert alert-success fw-bold">Não há novas solicitações de cadastro!!</div>
    @endif

    <div class="modal fade" tabindex="-1" id="confirmModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="confirmModal" onclick="closeConfirmModal()" aria-label="Close"></button>
                </div>
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <span id="nome_aluno"></span>
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

@endsection


@section('script')

    <script type="text/javascript">

        // FUNÇÕES - MODAL DE REMOÇÃO //
        function showConfirmModal(id, nome, response) {

            let input_status = '#status_' + id
            
            $('#id').val(id)
            $('#confirmModal').modal().find('.modal-title').html("")
            $("#nome_aluno").html("")
            $('#nome_aluno').append(nome)
            $("#title_modal").removeClass()
            $("#button_y").removeClass()
            $("#comentario").removeClass()
            $('#nome_aluno').removeClass()

            if(response) {
                $(input_status).val(1)
                $('#title_modal').addClass("modal-title text-success")
                $('#nome_aluno').addClass("fw-bold text-success")
                $('#confirmModal').modal().find('.modal-title').append("ACEITAR NOVA SOLICIRAÇÃO DE CADASTRO?")
                $('#button_y').addClass("btn btn-success")
            }
            else {
                $(input_status).val(0)
                $('#title_modal').addClass("modal-title text-danger")
                $('#nome_aluno').addClass("fw-bold text-danger")
                $('#confirmModal').modal().find('.modal-title').append("NEGAR NOVA SOLICITAÇÃO DE CADASTRO?")
                $('#button_y').addClass("btn btn-danger")
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

@endsection