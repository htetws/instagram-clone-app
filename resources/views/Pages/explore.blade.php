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

<body>

    <div class="container m-auto mt-3 px-md-3 mt-md-5 d-flex">

        <div class="me-5 d-none d-md-block side"> @include('Components.side')</div>

        <div class="explore_items timeline mt-5 mt-md-0">
            @forelse ($posts as $post)
            <div class="col-12 position-relative py-2">
                <img src="{{ asset('storage/'.$post->images[0]->images) }}" style="width:100%">
                <div class="images fs-4">
                    @if ($post->images->count() > 1)
                    <i class="fa-solid fa-images"></i>
                    @endif
                </div>
                <a href="{{ route('post.detail',$post->id) }}" role="button" class="exploreText">
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
                </a>
            </div>
            @empty
            <div class="d-flex justify-content-center align-items-center" style="height: 65vh;">
                <img src="{{ asset('images/undraw_not_found_re_bh2e.svg') }}" style="width:90%">
            </div>
            @endforelse
        </div>

    </div>
    @include('Components.bar')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('#search').keyup(function() {
            $input = $(this).val();
            $div = "";

            $.post("{{ route('search') }}", {
                'input': $input,
                _token: "{{ csrf_token() }}"
            }, (data) => {
                if (data.length > 0) {
                    data.forEach(user => {
                        $avatar = user.avatar != null ? `{{ asset('storage/${user.avatar}') }}` : `https://i.pravatar.cc/150?u=${user.email}`;
                        $url = `{{ url('/${user.username}') }}`;
                        $div += `<a href="${$url}" class="d-flex align-items-center ms-2 mb-4">
                            <img src="${$avatar}" class="rounded-circle" width="55" height="55" style="object-fit: cover;">
                            <div class="ms-3">
                                <div class="fw-bold" style="font-size: 1.2rem;">${user.username}</div>
                                <div><small class="text-muted">${user.name}</small></div>
                            </div>
                        </a>`;
                    });
                    setTimeout(function() {
                        $('.SearchUser').html($div)
                    }, 1500)
                    $('.SearchUser').html(`<div class="sk-circle"><div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div>`)
                } else {
                    setTimeout(function() {
                        $('.SearchUser').html(`<div class="d-flex flex-column justify-content-center align-items-center" style="height: 55vh;">
                            <div class="fw-light fs-4">No results found.</div>
                        </div>`)
                    }, 1500)
                    $('.SearchUser').html(`<div class="sk-circle"><div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div>`)
                }
            });

        })
    </script>
</body>

</html>
