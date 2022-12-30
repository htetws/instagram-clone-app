<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header p-2 d-flex align-items-center">
                    <div class="fw-bold ms-2">Create new post</div>
                    <input type="submit" class="ms-auto pe-1 border-0 text-primary bg-transparent fs-6 fw-bold" value="Share">
                </div>
                <div class="modal-body">
                    <input type="text" name="caption" class="form-control border-0 @error('caption')
                    is-invalid @enderror" placeholder="Write a caption ...">
                    @error('caption')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <hr>
                    <div class="m-auto mt-4">
                        <input type="file" name="images[]" class="form-control form-control bg-transparent @error('images') is-invalid @enderror" multiple>
                        @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
