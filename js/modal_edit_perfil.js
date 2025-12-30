// Open edit modal
function openEditModal() {
    const modal = new bootstrap.Modal(document.getElementById('editModal'));
    modal.show();
}

// Close edit modal
function closeEditModal() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
    if (modal) {
        modal.hide();
    }
}

// Handle photo upload and preview
function previewImage() {
    const input = document.getElementById('photoInput');
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('photoPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

// Event listener for photo input (fallback)
document.getElementById('photoInput').addEventListener('change', previewImage);