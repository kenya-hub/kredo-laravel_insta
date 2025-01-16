{{-- Clicable Image --}}
<div class="container p-0">
    <a href="{{ route('post.show', $post->id) }}">
        <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="w-100">
    </a>
</div>

<div class="card-body">
    {{-- Heart/Like button + No. of Likes + Categories --}}
    <div class="row align-items-center">
        <div class="col-auto">
            <form action="" method="post">
                @csrf
                <button type="submit" class="btn btn-sm shadow-none p-0">
                    <i class="fa-regular fa-heart"></i>
                </button>
            </form>
        </div>

        <div class="col-auto px-0">
            <span>3</span>
        </div>

        <div class="col text-end">
            @foreach($post->categoryPost as $category_post)
                <span class="badge bg-secondary bg-opacity-50">
                    {{ $category_post->category->name }}
                </span>
            @endforeach
        </div>
    </div>

    {{-- Owner Description --}}
    <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark fw-bold">
        {{ $post->user->name }}
    </a>
    &nbsp; {{--  nbsp = non-breaking space --}}
    <p class="d-inline fw-light">{{ $post->description }}</p>
    <p class="text-uppercase text-muted xsmall">{{ date('M d, Y' , strtotime($post->created_at)) }}</p>

    {{-- iclude comment form here --}}
    @include('users.posts.contents.comments')

</div>