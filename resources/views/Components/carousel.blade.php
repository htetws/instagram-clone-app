<div id="{{ Str::words($post->caption,1,'And') }}{{ $post->id }}{{ str_replace('@','-',$post->user->username) }}" class="carousel slide" data-bs-interval="false">

    <div class="carousel-indicators">
        @foreach ($post->images as $key => $image)

        <button type="button" data-bs-target="#{{ Str::words($post->caption,1,'And') }}{{ $post->id }}{{ str_replace('@','-',$post->user->username) }}" data-bs-slide-to="{{ $key }}" class="{{ $key !== 0 ?: 'active' }}"></button>

        @endforeach

    </div>


    <div class="carousel-inner">
        @foreach ($post->images as $key => $image)

        <div class="carousel-item {{ $key !== 0 ?: 'active' }}">
            <img src="{{ asset('storage/'.$image->images) }}" style="height:32rem;object-fit:cover" class="d-block w-100">
        </div>

        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#{{ Str::words($post->caption,1,'And') }}{{ $post->id }}{{ str_replace('@','-',$post->user->username) }}" data-bs-slide="prev">
        <i class="fa-solid fa-circle-chevron-left fs-4 me-4"></i>
        <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#{{ Str::words($post->caption,1,'And') }}{{ $post->id }}{{ str_replace('@','-',$post->user->username) }}" data-bs-slide="next">
        <i class="fa-solid fa-circle-chevron-right fs-4 ms-4"></i>
        <span class="visually-hidden">Next</span>
    </button>
</div>

@section('jquery')
<script>
    $(document).ready(function() {
        $('.carousel').carousel({
            interval: 1000,
            wrap: false
        })
    });
</script>
@endsection
