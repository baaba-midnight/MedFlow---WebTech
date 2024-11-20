<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>To confirm deletion, type <strong>"DELETE"</strong> in the field below:</p>
            <input type="text" id="confirmDeleteInput" class="form-control" placeholder="Type 'DELETE'" />
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" id="confirmDeleteButton" class="btn btn-danger" disabled>Delete</button>
        </div>
        </div>
    </div>
</div>