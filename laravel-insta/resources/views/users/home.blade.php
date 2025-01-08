@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row gx-5">
        {{-- POSTS --}}
        <div class="col-8 bg-warning">
            <div class="text-center">
                <h2>Share Photos</h2>
                <p class="text-muted">When you sher photos, they'll appear on your profile</p>
                <a href="" class="text-decoration-none">
                    Share your first photo
                </a>
            </div>
        </div>

        {{-- PROFILE OVERVIEW + SUGGESTIONS --}}
        <div class="col-4 bg-secondary">
            PROFILE OVERVIEW + SUGGESTIONS
        </div>

    </div>
@endsection
