        <div class="row">
            <div class="col-md-3 d-none d-md-block mx-auto side">
                @include('Components.side')
            </div>
            <div class="col-12 px-0 col-md-6 mx-auto timeline my-5 my-md-2">

                <div class="row d-flex align-items-center m-auto ms-md-5 px-1">
                    <div class="col-4 mx-auto px-0 my-3 col-sm-12 col-md">
                        <img src="{{ $user->getAvatar() }}" width="150" height="150" style="object-fit:cover" class="rounded-circle">

                    </div>

                    <div class="col-12 col-md-8">
                        <div class="d-flex justify-content-center justify-content-md-start">
                            <div class="fs-4 scroll_username">{{ $user->username  }}</div>
                            <div class="button ms-4">

                                @can('edit', $user)
                                <button data-bs-target="#profile-modal" data-bs-toggle="modal" class="btn btn-white shadow-sm rounded-2 d-none d-md-block">Edit profile</button>
                                @endcan

                                @unless(auth()->user()->is($user))
                                <form action="{{ route('follow',$user->username) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn {{ auth()->user()->isFollowing($user) ? 'btn-secondary' :'btn-primary' }} opacity-75 btn-sm rounded-1">
                                        {{ auth()->user()->isFollowing($user) ? 'Following' :'Follow' }}
                                    </button>
                                </form>
                                @endunless

                            </div>
                            <!-- <i class="fa fa-solid fa-sun fs-5 ms-5"></i> -->
                        </div>

                        <div class="d-flex justify-content-center justify-content-md-start align-items-center mt-2">
                            <p><span class="fw-bold">{{ $user->posts->count() }}</span>
                                @if ($user->posts->count() === 0)
                                <span>post</span>
                                @elseif($user->posts->count() === 1)
                                <span>post</span>
                                @elseif($user->posts->count() > 1)
                                <span>posts</span>
                                @endif
                            </p>


                            <p class="ms-5">
                            <p><span class="fw-bold">{{ $user->follower->count() }}</span>
                                @if ($user->follower->count() === 0)
                                <span>follower</span>
                                @elseif($user->follower->count() === 1)
                                <span>follower</span>
                                @elseif($user->follower->count() > 1)
                                <span>followers</span>
                                @endif
                            </p>

                            <p class="ms-5">
                                <span class="fw-bold">{{ $user->follows->count() }}</span> following
                            </p>
                        </div>

                        <hr class="d-md-none">
                        <div class="">
                            <div class="fw-bold fs-5">{{ $user->name }}</div>
                            <div class="mt-1 text-muted">{{ $user->bio }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
