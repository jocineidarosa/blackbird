<form id="form_logout" name="form_logout" method="post" action="{{route('logout')}}">
    @csrf
    <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Selecione "Logout" se realmente deseja finalizar a seção atual?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="data_id" id="data_id">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Sair</button>
                </div>
            </div>
        </div>
    </div>
</form>