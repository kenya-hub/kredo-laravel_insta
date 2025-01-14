@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row gx-5">
        {{-- POSTS --}}
        <div class="col-8">
            @forelse($all_posts as $post)
                <div class="card mb-4">
                    {{-- Post Title --}}
                    @include('users.posts.contents.title')

                    {{-- Post Body --}}
                    @include('users.posts.contents.body')

                </div>
            @empty
                {{-- If the website or user does note have any posts, display thie content. --}}
                <div class="text-center">
                    <h2>Share Photos</h2>
                    <p class="text-muted">When you sher photos, they'll appear on your profile</p>
                    <a href="{{ route('post.create') }}" class="text-decoration-none">
                        Share your first photo
                    </a>
                </div>
            @endforelse
        </div>

        {{-- PROFILE OVERVIEW + SUGGESTIONS --}}
        <div class="col-4 bg-secondary">
            PROFILE OVERVIEW + SUGGESTIONS
        </div>

    </div>
@endsection
