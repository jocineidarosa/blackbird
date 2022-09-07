<form id="form_delete" name="form_delete" method="post" action="{{$slot}}">
    @method('DELETE')
    @csrf
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Confirma a exclusão do registro?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="data_id" id="data_id">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var recipientId = button.data('id');
        console.log(recipientId);
        var modal = $(this);
        modal.find('#data_id').val(recipientId);
    })
</script>