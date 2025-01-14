<div class="mt-3">
    {{-- show all comments of the post here --}}

    <form action="{{ route('comment.store', $post->id) }}" method="post">
        @csrf

        <div class="input-group">
            <textarea name="comment_body" rows="1" placeholder="Add a comment..." class="form-control form-control-sm">{{ old('comment_body')}}</textarea>
    
            <button type="submit" class="btn btn-outline-secondary btn-sm">
                <i class="fa-regular fa-paper-plane"></i>
            </button>
        </div>
        {{-- error --}}
        @error('comment_body')
            <div class="text-danger small">{{ $message }}</div>            
        @enderror
    </form>
</div>