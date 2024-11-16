document.addEventListener('DOMContentLoaded', () => {
    const confirmInput = document.getElementById('confirmDeleteInput');
    const confirmButton = document.getElementById('confirmDeleteButton');

    // Enable the delete button only when "delete" is typed
    confirmInput.addEventListener('input', () => {
        confirmButton.disabled = confirmInput.value.trim().toUpperCase() !== 'DELETE';
    });

    // Handle delete confirmation logic
    confirmButton.addEventListener('click', () => {
        alert('Item deleted successfully!'); // Replace with your deletion logic
        // Reset input and close the modal
        confirmInput.value = '';
        confirmButton.disabled = true;
        const modal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmationModal'));
        modal.hide();
    });
});