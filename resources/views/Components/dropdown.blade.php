<div class="dropdown">
    <button class="bg-transparent border-0 fw-bold fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false">. . .</button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('post.detail',$post->id) }}">Go to post</a></li>

        @can('edit',$post->user)
        <!-- <li><a class="dropdown-item" href="{{ route('post.edit',$post->id) }}">Edit post</a></li> -->
        <div class="dropdown-divider"></div>
        <li><button class="dropdown-item deletePost" data-id="{{ $post->id }}">Delete post</button></li>
        @endcan

    </ul>
</div>
