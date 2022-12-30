<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Explore</title>
</head>

<body class="bg-light">

    <div class="container m-auto mt-3 px-md-3 mt-md-5">
        <div class="row">
            <div class="d-none d-md-block side"> @include('Components.side')</div>

            <div class="col-md-8 explore_items bg-white timeline mt-5 mt-md-0 p-2">
                <div class="ImageDiv col-12">
                    @include('Components.carousel',['post'=>$post])
                </div>
                <div class="position-relative">
                    <div class="d-flex justify-content-between ms-2 align-items-center py-3 bg-white w-100 position-absolute top-0 z-50">
                        <div class="d-flex align-items-center">
                            <img src="{{ $post->user->getAvatar() }}" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                            <a href="{{ route('profile',$post->user->username) }}" class="ms-3 fs-6 fw-bold">{{$post->user->username}}</a>
                        </div>
                        <div class="follow fw-bold text-primary me-4">
                            <input type="hidden" value="{{ $post->user->id }}" id="userId">
                            @if (auth()->user()->isFollowing($post->user))
                            <span class="text-dark">Following</span>
                            @elseif (auth()->user()->is($post->user))
                            <span class="">Your post</span>
                            @else
                            <span role="button" id="follow"><span class="isFollow">Follow</span></span>
                            @endif
                        </div>
                    </div>
                    <div class="overflow-auto Cmts" style="height: 32rem;padding-top:5rem;padding-bottom:4.5rem;">
                        @forelse ($post->comments as $cmt)
                        <div class="d-md-flex ms-2 mb-4 justify-content-between">
                            <div class="d-flex">
                                <img src="{{ $cmt->user->getAvatar() }}" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                                <div class="ms-3">
                                    <a href="{{route('profile',$cmt->user->username)}}" class="fw-bold text">{{ $cmt->user->username }}</a>
                                    <span class="ms-2 text-muted CMT">{{ $cmt->comment }}</span>
                                    <div class="text-muted z-0"><small>{{ $cmt->created_at->diffForHumans(null,true) }}</small></div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="d-flex flex-column justify-content-center align-items-center" style="height: 40vh;">
                            <div class="fw-bold fs-4">No comments yet</div>
                            <div>start the conversation.</div>
                        </div>
                        @endforelse
                    </div>
                    <div class="d-flex flex-column ms-2 justify-content-center align-items-start py-1 bg-white bg w-100 position-absolute bottom-0 z-50">
                        <div class="my-1 fw-bold">
                            <span class="like">{{ $post->likes->count() }} {{ $post->likes->count() > 1 ? 'likes' : 'like' }}</span>
                        </div>
                        <small class="mb-2 opacity-75 text-muted">
                            {{ $post->created_at->format('F d, Y') }}
                        </small>
                        <div class="d-flex mb-5 mb-md-0 w-100 justify-content-between align-items-center">
                            <i role="button" id="loveBtn" class="{{ auth()->user()->isLike($post) ? 'fa-solid text-danger' : 'fa-regular' }} fa-heart fs-2 opacity-75"></i>

                            <input type="text" name="caption" class="comment form-control border-0 bg-transparent ms-3" placeholder="Add a comment...">
                            <input type="submit" value="Post" class="cmt_btn border-0 bg-transparent text-primary fw-bold ms-2 me-4">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('Components.bar')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('jquery')

</body>

<script>
    $(document).ready(function() {
        $('#loveBtn').click(function() {
            $(this).toggleClass('fa-solid fa-regular text-danger')
            $id = $(location).attr('pathname').slice(3, 4);
            $.post("{{ route('detail.like') }}", {
                'id': $id,
                _token: "{{ csrf_token() }}"
            }, (data) => {
                $('.like').text(data.length > 1 ? `${data.length} likes` : `${data.length} like`);
            })
        })
        $('.cmt_btn').click(function() {
            $input = $('.comment').val();
            $id = $(location).attr('pathname').slice(3, 4);
            if ($input.length > 0) {
                $.post("{{ route('detail.cmts') }}", {
                    'id': $id,
                    'input': $input,
                    _token: "{{ csrf_token() }}"
                }, (data) => {
                    $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    $div = '';
                    data.forEach(cmt => {
                        $day = new Date(cmt.created_at).getDate();
                        $mon = new Date(cmt.created_at).getMonth();
                        $date = `${$day}, ${$month[$mon]}`;

                        $avatar = cmt.user.avatar != null ? `{{ asset('storage/${cmt.user.avatar}') }}` : `https://i.pravatar.cc/150?u=${cmt.user.email}`;

                        $url = `{{ url('/${cmt.user.username}') }}`;

                        $div += `<div class="d-md-flex ms-2 mb-4 justify-content-between">
                            <div class="d-flex">
                                <img src="${$avatar}" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                                <div class="ms-3">
                                    <a href="${$url}" class="fw-bold text">${cmt.user.username}</a>
                                    <span class="ms-2 text-muted CMT">${cmt.comment}</span>
                                    <div class="text-muted z-0"><small>${$date}</small></div>
                                </div>
                            </div>
                        </div>`;
                    });
                    $('.Cmts').html($div);
                    $('.comment').val('');
                })
            }
        })
        $('#follow').click(function() {
            $user_id = $('#userId').val();
            $.post("{{ route('detail.follow') }}", {
                'id': $user_id,
                _token: "{{ csrf_token() }}"
            }, (data) => {
                $('.isFollow').text('Following').addClass('text-dark')
            })
        })
    })
</script>

</html>
