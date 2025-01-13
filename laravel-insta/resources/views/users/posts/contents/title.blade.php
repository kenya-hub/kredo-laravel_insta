<div class="card-header bg-white py-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <a href="#">
                @if($post->user->avatar)
                    <img src="" alt="{{ $post->user->name }}" class="rounded-circle avatar-sm">    
                
                @else
                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                @endif
            </a>
        </div>

        <div class="col ps-0">
            <a href="" class="text-decoration-none text-dark">{{ $post->user->name }}</a>
        </div>

        <div class="col-auto">
            <div class="dropdown">
                <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>

                {{-- IF the logged in USER is owner of the POST display the EDIT and DELETE buttons --}}
                @if(Auth::user()->id === $post->user->id)
                    <div class="dropdown-menu">
                        {{-- edit --}}
                        <a href="{{ route('post.edit', $post->id)}}" class="dropdown-item">
                            <i class="fa-regular fa-pen-to-square"></i> EDIT
                        </a>
                        {{-- delete --}}
                        <button class="dropdown-item text-danger" data-bs-toggle="modal"
                        data-bs-target="#delete-post-{{ $post->id }}">
                            <i class="fa-solid fa-trash-can"></i> Delete
                        </button>
                    </div>
                    {{-- INCLUDE MODAL HERE --}}
                    @include('users.posts.contents.modals.delete')
                @else
                    {{-- If the logged in user is not the owner , show an UNFOLLOW and FOLLOW Button --}}
                    <div class="dropdown-menu">
                        <form action="" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="dropdown-item text-danger">Unfollow</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>