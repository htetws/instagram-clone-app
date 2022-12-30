<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <title>Home Page</title>
</head>

<body class="bg-light">
    <div class="container m-auto mt-3 px-md-3 mt-md-5">
        <div class="row">
            <div class="col-md-3 d-none d-md-block mx-auto side">
                @include('Components.side')

            </div>
            <div class="col-12 px-0 col-md-6 timeline my-5 my-md-1">
                @include('Pages.timeline',['posts'=>$posts])
            </div>

            <div class="col-md-3 mt-3 d-none d-xl-block mx-auto">
                @include('Components.suggestion',['posts'=>$posts])
            </div>
        </div>
    </div>

    @include('Components.bar',['user'=>null])

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="http://unpkg.com/turbolinks"></script> -->
    @yield('jquery')
</body>

<script>
    $(document).ready(function() {
        @if(session('updated'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "timeOut": "3000",
        }
        toastr.success("{{ session('updated') }}");
        @endif

        //toggle save btn
        $('.likeBtn').click(function() {
            if ($(this).hasClass('fa-regular')) {
                $(this).removeClass('fa-regular');
                $(this).addClass('fa-solid text-danger');

                $parent = $(this).parents('.parentDiv');
                $id = $parent.find('#postID').val();

                $LikeParent = $(this).parents('.border');

                $.post("{{ route('like') }}", {
                    'id': $id,
                    _token: "{{ csrf_token() }}"
                }, (data) => {
                    $LikeParent.find('.likeCount').text(data)
                })

            } else {
                $(this).removeClass('fa-solid text-danger');
                $(this).addClass('fa-regular');

                $parent = $(this).parents('.parentDiv');
                $id = $parent.find('#postID').val();

                $LikeParent = $(this).parents('.border');

                $.post("{{ route('like') }}", {
                    'id': $id,
                    _token: "{{ csrf_token() }}"
                }, (data) => {
                    $LikeParent.find('.likeCount').text(data)
                })
            }
        })

        $('.cmtBtn').click(function() {
            $parent = $(this).parents('.parentDiv');
            $id = $parent.find('#postID').val();
            $.post("{{ route('getPost') }}", {
                'id': $id,
                _token: "{{ csrf_token() }}"
            }, (data) => {
                $img = '';
                $cmts = '';
                $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                data.images.forEach((image, index) => {
                    $img += `<div class="carousel-item ${index == 0 ? 'active':''}">
                                <img src="{{ asset('storage/${image.images}') }}" class="d-block w-100 carousel_img" alt="${index}">
                            </div>`;
                });
                $('.CAROUSEL').html($img);

                $topAvatar = data.user.avatar != null ? `{{ asset('storage/${data.user.avatar}') }}` : `https://i.pravatar.cc/150?u=${data.user.email}`;

                $('.test').html(`<img src="${$topAvatar}" class="rounded-circle avatar_img" width="45" height="45" style="object-fit: cover;"><div class="fw-bold ms-3 username">${data.user.username}</div>`)


                if (data.comments.length > 0) {
                    data.comments.forEach(cmt => {

                        $day = new Date(cmt.created_at).getDate();
                        $mon = new Date(cmt.created_at).getMonth();
                        $date = `${$day}, ${$month[$mon]}`;

                        $avatar = cmt.user.avatar != null ? `{{ asset('storage/${cmt.user.avatar}') }}` : `https://i.pravatar.cc/150?u=${cmt.user.email}`;

                        $cmts += `<div class="d-flex ms-2 mb-4 justify-content-between" id="cmtDiv">
                            <div class="d-flex">
                            <img src=${$avatar} class="rounded-circle" width="45" height="45" style="object-fit: cover;">
                            <div class="ms-3">
                                <span class="fw-bold text">${cmt.user.username}</span>
                                <span class="ms-2 text-muted CMT">${cmt.comment}</span>
                                <div class="opacity-75"><small class="dat">${$date}</small></div>
                            </div>
                            </div>
                        </div>`;
                    });
                    $('.Cmts').html($cmts);
                } else {
                    $('.Cmts').html(`<div class="d-flex flex-column justify-content-center align-items-center" style="height: 55vh;">
                            <div class="fw-bold fs-4">No comments yet</div>
                            <div class="text-muted">start the conversation.</div>
                        </div>`);
                }
            });
        })

        $('.ViewAll').click(function() {
            $parent = $(this).parents('.border');
            $parent.find('.cmtBtn').click();
        })

        $('.PostBtn').click(function() {
            $parent = $(this).parents('.border');
            $id = $parent.find('#postID').val();
            $input = $parent.find('.Comment').val();

            if ($input.length > 0) {

                $.post("{{ route('comment') }}", {
                    'id': $id,
                    'input': $input,
                    _token: "{{ csrf_token() }}"
                }, (data) => {
                    $parent.find('.CmtTotal').text(data.length)
                    $parent.find('.Comment').val('');
                })
            }
        })

        $('.Bookmark').click(function() {
            if ($(this).hasClass('fa-regular')) {
                $(this).removeClass('fa-regular');
                $(this).addClass('fa-solid');

                $parent = $(this).parents('.parentDiv');
                $id = $parent.find('#postID').val();

                $.post("{{ route('save') }}", {
                    'id': $id,
                    _token: "{{ csrf_token() }}"
                }, (data) => {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "timeOut": "3000",
                    }
                    toastr.remove();
                    toastr.success("saved post.");
                })

            } else {
                $(this).removeClass('fa-solid');
                $(this).addClass('fa-regular');

                $parent = $(this).parents('.parentDiv');
                $id = $parent.find('#postID').val();

                $.post("{{ route('save') }}", {
                    'id': $id,
                    _token: "{{ csrf_token() }}"
                }, (data) => {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "timeOut": "3000",
                    }
                    toastr.remove();
                    toastr.info("removed from saved items.");
                })
            }
        })

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
    })
</script>

</html>
