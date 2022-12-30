<div class="d-flex align-items-center">
    <img src="{{ auth()->user()->getAvatar() }}" width="65" height="65" class="rounded-circle" alt="user_profile">
    <div class="Text ms-md-4">
        <div class="fs-5 fw-bold"><a href="{{ route('profile',auth()->user()->username) }}">{{ auth()->user()->name }}</a></div>
        <div class="text-muted">{{ auth()->user()->username }}</div>
    </div>
</div>

<!-- suggestion -->
<div class="mt-5">
    <div class="row">
        <h6 class="col-7 text-muted opacity-75 ">Suggestions For You</h6>
        <a href="#" class="col-5 text-end">
            <h6 class="col opacity-75 " style="letter-spacing: .07rem;">See All</h6>
        </a>
    </div>

    @forelse ($users as $suggest)
    <div class=" d-flex align-items-center justify-content-between mt-4">
        <div class="d-flex">
            <img src="{{ $suggest->getAvatar() }}" width="45" height="45" class="rounded-circle" alt="user_profile">
            <div class="Text ms-md-3">
                <div class="fs-6 fw-bold"><a href="{{ route('profile',$suggest->username) }}">{{ $suggest->name }}</a></div>
                <small class="text-muted">suggested for you</small>
            </div>
        </div>
        <div class="">
            <form action="{{ route('follow',$suggest->username) }}" method="post" class="m-auto">
                @csrf
                <button type="submit" class="border-0 bg-transparent text-primary fw-bold fs-6 ms-md-4">Follow</button>
            </form>
        </div>
    </div>
    @empty
    <div class="text-center mt-5 fs-5"> No User found . </div>
    @endforelse

</div>
