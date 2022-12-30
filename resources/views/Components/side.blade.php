<ul class="list-unstyled ms-md-5">
    <li class="instagram">Instagram</li>
    <li class="my-5 fs-5 fw-bold {{ request()->is('/') ? 'text-primary' : '' }}"><a href="{{ route('home') }}"><i class="fa-solid fa-house me-3"></i>Home</a></li>
    <li class="my-5 fs-5 fw-bold" role="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop"><i class="fa-solid fa-magnifying-glass me-3"></i>Search</li>
    <li class="my-5 fs-5 fw-bold {{ request()->is('explore') ? 'text-primary' : '' }}"><a href="{{route('explore')}}"><i class="fa-regular fa-compass me-3"></i>Explore</a></li>
    <li class="my-5">
        <button class="border-0 bg-transparent fs-5 fw-bold opacity-80 {{ request()->is('/') ?: 'd-none' }}" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-regular fa-square-plus me-3 pe-1"></i>Create</button>
    </li>
    <li class="my-5 fs-5 fw-bold {{ url()->current() == route('profile',auth()->user()->username) ? 'text-primary' : '' }}"><a href="{{ route('profile',auth()->user()->username) }}"><i class="fa-regular fa-user me-3"></i> Profile</a></li>

    <li class="my-5 fs-5 fw-bold">
        <form action="{{ route('logout') }}" method="POST" class="m-auto">
            @csrf
            <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>
            <button type="submit" class="border-0 fw-bold bg-transparent">logout</button>
        </form>
    </li>
</ul>

@include('Components.offcanvas')
