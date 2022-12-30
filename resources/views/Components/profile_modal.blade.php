    <div class="modal fade" id="profile-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $user->name }} | Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.edit',$user->username) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="mb-1">Username</label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username',$user->username) }}" placeholder="Enter username">
                            @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label class="mb-1">Display name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$user->name) }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label class="mb-1">Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$user->email) }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label class="mb-1">Bio</label>
                            <textarea name="bio" rows="2" class="form-control @error('bio') is-invalid @enderror" placeholder="Your bio">{{ old('bio',$user->bio) }}</textarea>
                            @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row mt-3">
                            <label class="mb-1">Avatar</label>
                            <div class="col-8 col-md-9">
                                <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
                                @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-3">
                                <input type="submit" value=" Update " class="btn btn-primary opacity-75 rounded-1">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
