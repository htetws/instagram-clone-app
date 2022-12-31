@forelse ($posts as $post)
<div class="border col-12 col-lg-9 mx-auto rounded-4 mt-md-2 mb-4 mb-md-2">

    <div class="d-flex justify-content-between align-items-start p-2 mx-2">
        <div class="d-flex align-items-center">
            <img id="avatar" src="{{ $post->user->getAvatar() }}" width="45" height="45" class="rounded-circle" alt="user_profile">
            <div class="Text ms-3 ms-md-4">
                <div class="fs-6 fw-bold"><a href="{{ route('profile',$post->user->username) }}">{{ $post->user->name }}</a></div>
                <small class="text-muted">{{ auth()->user()->isFollowing($post->user) ? 'Following' :'Suggestion' }}</small>
            </div>
        </div>

        @include('Components.dropdown')
    </div>

    @include('Components.carousel',['post'=>$post])

    <div class="parentDiv d-flex justify-content-between fs-3 opacity-75 px-3 py-1">
        <div class="left-icon">
            <input type="hidden" id="postID" value="{{ $post->id }}">

            @if(auth()->user()->isLike($post))
            <i role="button" class="likeBtn fa-solid fa-heart text-danger"></i>
            @else
            <i role="button" class="likeBtn fa-regular fa-heart"></i>
            @endif

            <i role="button" class="fa-regular fa-comment ms-3 cmtBtn border-0 bg-transparent" data-bs-target="#postDetail" id="Testing" data-bs-toggle="modal"></i>

            <i class="fa-regular fa-share-from-square ms-3 text-muted"></i>
        </div>
        <div class="right-icon">
            <i role="button" class="Bookmark {{ auth()->user()->isSaved($post) ? 'fa-solid' : 'fa-regular' }} fa-bookmark"></i>
        </div>
    </div>

    <div class="px-3 fs-6 fw-bold">
        <span class="likeCount">{{ $post->likes->count() }}</span>
        <span class="ms-1">likes</span>
    </div>

    <div class="px-3 mt-2">
        <h6>{{ $post->user->name }} <span class="opacity-75 ms-1">{{ $post->caption }}</span>
        </h6>
        <button class="border-0 bg-transparent ViewAll text-secondary" role="button"><span class="text-dark opacity-75">View all <span class="CmtTotal">{{ $post->totalComment() }}</span> {{ $post->totalComment() > 1 ? 'comments' : 'comment' }} </span>
        </button>
        <div class="text-secondary mt-1 opacity-75"><small class="text-uppercase" style="font-size: .83rem;">
                {{ $post->created_at->diffForHumans() }}</small></div>
    </div>
    <hr class="mb-2">
    <div class="px-3 my-2 d-flex justify-content-between align-items-center">
        <i class="fa-regular fa-face-laugh-beam fs-2 opacity-75"></i>

        <input type="text" name="caption" class="Comment form-control border-0 bg-transparent" placeholder="Add a comment...">
        <input type="submit" value="Post" class="PostBtn border-0 bg-transparent text-primary fw-bold">

    </div>
</div>
@include('Components.postDetail',['post' => $post])
@empty

<div class="d-flex flex-column align-items-center justify-content-center" style="height:70vh">
    <img style="width: 28%;" src="{{ asset('images/undraw_void_-3-ggu.svg') }}" class="img-fluid">
    <p class="text-muted fs-5 mt-4">Create new post or follow someone .</p>
</div>

@endforelse

@include('Components.create_modal')
