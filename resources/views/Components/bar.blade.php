<div class="bg-light border container-fluid d-md-none d-flex bar text-center p-2 fs-4 fw-bold" style="z-index: 100;">
    <div class="col">
        <a href="{{ route('home') }}"><i class="fa-solid fa-house me-3 {{ request()->is('/') ? 'text-primary' : '' }}"></i></a>
    </div>
    <div class="col">
        <i class="fa-solid fa-magnifying-glass me-3"></i>
    </div>
    <div class="col">
        <a href="{{ route('explore') }}"><i class="fa-regular fa-compass me-3"></i></a>
    </div>
    <div class="col {{ url()->current() == route('home') ?: 'd-none' }}">
        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-regular fa-square-plus me-3"></i></a>
    </div>
    <div class="col">
        <a href="{{ route('profile',auth()->user()->username) }}"><i class="fa-regular fa-user me-3 {{ url()->current() == route('profile',auth()->user()->username) ? 'text-primary' : '' }}"></i></a>
    </div>
</div>

<div class="bg-white border fs-3 px-3 py-2 bar-top w-100 d-md-none">
    <div class="d-flex justify-content-between align-items-center">
        <div class="instagram fs-2">instagram</div>
        <div class="">

            @isset($user)

            @can('edit',$user)
            <button data-bs-target="#profile-modal" data-bs-toggle="modal" class="border-0 bg-transparent"><i class="fa-regular fa-address-card me-3"></i></button>
            @endcan

            @endisset

            <a href="#"> <i class="fa-regular fa-heart"></i></a>
        </div>
    </div>
</div>

@include('Components.offcanvas')
