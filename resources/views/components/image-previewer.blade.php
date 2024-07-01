<div class="modal" id="image-previewer" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" @click="">Preview Image
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="image-previewer-src" src="#" class="w-full h-full">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Alpine.store('previewImage', {
                modalId: 'image-previewer',
                imageSrcId: 'image-previewer-src',
                imageUrl: '#',

                preview(url) {
                    if (url !== '#') {
                        let imagePreviewerElement = document.getElementById(this.modalId);
                        let imageSrcElement = document.getElementById(this.imageSrcId);
                        imageSrcElement.src = url;
                        let modal = bootstrap.Modal.getOrCreateInstance(imagePreviewerElement);
                        modal?.show();
                        imagePreviewerElement.addEventListener('hidden.bs.modal', (event) => {
                            this.imageUrl = '#';
                        });
                    }
                }
            })
        })
    </script>
@endpush

