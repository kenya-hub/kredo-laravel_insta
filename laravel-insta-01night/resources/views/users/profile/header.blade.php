<div class="row">
    {{-- avatar --}}
    <div class="col-4">
        {{-- Display the avatar of the user --}}
        @if ($user->avatar)
            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle p-1 shadow mx-auto avatar-lg">
        @else
            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
        @endif
    </div>

    {{-- name, introduction --}}
    <div class="col-8">
        {{-- name & action buttons --}}
        <div class="row mb-3">
            {{-- name --}}
            <div class="col-auto">
                <h2 class="display-6 mb-0">{{ $user->name }}</h2>
            </div>

            {{-- action button --}}
            <div class="col-auto p-2">
                @if (Auth::user()->id === $user->id)
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm fw-bold">Edit Profile</a>
                @else
                    @if ($user->isFollowed())
                        {{-- unfollow user --}}
                        <form action="{{ route('follow.destroy' , $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Following</button>
                        </form> 
                    @else
                    {{-- follow user --}}
                    <form action="{{ route('follow.store', $user->id) }}" method="post">
                        @csrf

                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                    </form> 
                    @endif
                @endif
            </div>
        </div>

        {{-- links --}}
        <div class="row mb-3">
            {{-- profile/posts --}}
            {{-- condition ? true statement : false satement --}}
            <div class="col-auto">
                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">
                    <strong>{{ $user->posts->count() }}</strong> {{ $user->posts->count() == 1 ? 'post' : 'posts' }}
                </a>
            </div>

            {{-- followers --}}
            <div class="col-auto">
                <a href="" class="text-decoration-none text-dark">
                    <strong>{{ $user->followers->count() }}</strong> {{ $user->followers->count() == 1 ? 'follower' : 'followers' }}
                </a>
            </div>

            {{-- following --}}
            <div class="col-auto">
                <a href="" class="text-decoration-none text-dark">
                    <strong>{{ $user->following->count() }}</strong> following
                </a>
            </div>
        </div>

        <p class="fw-bold">{{ $user->introduction }}</p>
    </div>
</div>