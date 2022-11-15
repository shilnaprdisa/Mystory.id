<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" id="confirm">
                @csrf
                <input type="hidden" name="id" id="id" value="">
                <div class="modal-body">
                     Are you sure, you want to confirm?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
    function doneConfirm(id,url){
        $('#confirm').attr('action', url);
        $('#id').val(id);
        $('#confirmModal').modal('show');
    }
</script>
@endpush