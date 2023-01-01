<div class="modal fade modal-lg" id="postEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-transparent border-0">

            <div class="row modal-body">
                <div class="Image col-12 d-none d-lg-block col-md-7 text-center imageDiv bg-dark">

                    <div id="carouselExampleControls" class="carousel slide" data-bs-interval="false">

                        @if($post->images->count() > 0)
                        <div class="carousel-inner CAROUSEL">
                            @foreach ($post->images as $key=>$image)
                            <div class="carousel-item caro-div {{ $key === 0 ? 'active' : '' }}">
                                <input type="hidden" class="imageID" value="{{$image->id}}">
                                <button class="btn btn-danger rounded-circle imageDel position-absolute" data-id="{{$image->id}}"><small style="font-size: .8rem;">DL</small></button>
                                <img src="{{ asset('storage/'.$image->images) }}" class="d-block w-100 carousel_img_edit" alt="${index}">
                            </div>
                            @endforeach
                        </div>
                        @endif

                        @if ($post->images->count() > 0)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        @endif
                    </div>

                </div>
                <div class="col-12 col-xl-5 commentDiv bg-white pt-3">
                    <div class="avatar d-flex align-items-center justify-content-between">
                        <div class="test d-flex align-items-center ms-2">
                            <img src="{{ asset('storage/'.$post->user->avatar) }}" class="rounded-circle avatar_img" width="45" height="45" style="object-fit: cover;">
                            <div class="fw-bold ms-3 username">{{ $post->user->username }}</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr class="my-3">

                    <div class="d-flex flex-column justify-content-between">
                        <form action="{{route('post.edit',$post)}}" method="POST">
                            @csrf
                            <textarea name="caption_edit" class="bg-transparent border-0 w-100" rows="10" placeholder="Write a caption...">{{ old('caption',$post->caption) }}</textarea>

                            <button type="submit" class="w-100 btn btn-primary rounded-1 opacity-75" style="margin-top: 5rem;">Done</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
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
