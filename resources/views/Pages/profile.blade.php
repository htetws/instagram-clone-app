<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>{{ auth()->user()->name }}</title>
</head>

<body class="">
    <div class="container m-auto mt-3 px-md-3 mt-md-5">
        @include('Components.profile_top',['user'=>$user])

        <hr class="d-none d-md-block col-7 mx-auto">

        @include('Components.profile_button',['user'=>$user])
    </div>

    @include('Components.bar',['user'=>$user])

    <!-- Modal -->
    @include('Components.profile_modal',['user'=>$user])

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield('jquery')
</body>

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

</html>
