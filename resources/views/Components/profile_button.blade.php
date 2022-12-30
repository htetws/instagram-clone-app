<div class="col-md-7 mx-auto mt-md-3 mb-5 mb-md-0">
    <div class="row">
        @forelse ($user->posts as $post)
        <a href="{{ route('post.detail',$post->id) }}" class="col-12 col-md-6 g-3 p-md-4 position-relative mb-1">
            <img src="{{ asset('storage/'.$post->images[0]->images) }}" style="height:18rem;width:23rem;object-fit:cover" class="img-fluid profileImg">
            <div role="button" class="ProfileText">
                <div class="text-white d-flex align-items-center">
                    <i class="fa fa-solid fa-heart text-white fs-4">
                    </i><span class="ms-2 fs-5 fw-bolder">
                        {{ $post->likes->count() }}
                    </span>
                </div>
                <div class="text-white ms-5 d-flex align-items-center">
                    <i class="fa fa-solid fa-comment text-white fs-4">
                    </i><span class="ms-2 fs-5 fw-bolder">
                        {{ $post->totalComment() }}
                    </span>
                </div>
            </div>
        </a>
        @empty
        <div class="text-center">
            <img src="https://pbs.twimg.com/media/CidJXBuUUAEgAYu.jpg" alt="">
        </div>
        @endforelse
    </div>
</div>
