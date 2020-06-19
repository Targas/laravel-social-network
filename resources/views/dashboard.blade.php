@extends('layouts.master')

@section('content')
    <section class="row new-post">
        <div class="col-md-12 col-md-offset-3">
            <header>
                <h3>
                    WAZZUP!
                </h3>
            </header>

            <form
                action="{{ route('createpost') }}"
                method="post"
            >
                @csrf

                <div class="form-group">
                    <label
                        for="post_content"
                    >
                        Your Post
                    </label>

                    <textarea
                        class="form-control"
                        name="post_content"
                        id="post_content"
                        rows="3"
                    >

                    </textarea>
                </div>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Create
                </button>

                <input
                    type="hidden"
                    value="{{ Session::token() }}"
                    name="_token"
                >
            </form>
        </div>
    </section>

    @include('includes.message-block')

    <section class="row posts mt-5">
        <div class="col-md-6 col-md-offset-3">
            <header>
                <h3>
                    What other people say
                </h3>
            </header>

            @foreach ($posts as $post)
                <article
                    class="card post mb-3 postaaa"
                    data-postid="{{ $post->id }}"
                >
                    <div class="card-body post">
                        <p class="card-text">
                            {{ $post->post_content }}
                        </p>

                        <h6 class="card-subtitle mb-2 text-muted info">
                            {{ $post->user->piratename }} | {{ $post->created_at }}
                        </h6>

                        <div class="interaction">
                            <a
                                href=""
                                class="card-link"
                            >
                                like
                            </a>

                            <a
                                href=""
                                class="card-link"
                            >
                                dislike
                            </a>

                            @if(Auth::user() == $post->user)
                                <a
                                    href="#"
                                    class="card-link edit-post"
                                >
                                    edit
                                </a>

                                <a
                                    href="{{ route('post.delete', ['post_id' => $post->id]) }}"
                                    class="card-link"
                                >
                                    delete
                                </a>
                            @endif
                        </div>

                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <div
        class="modal"
        tabindex="-1"
        role="dialog"
        id="edit-modal"
    >
        <div
            class="modal-dialog"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label
                                for="modal-post_content"
                            >
                                Edit the post
                            </label>

                            <textarea
                                class="form-control"
                                name="modal-post_content"
                                id="modal-post_content"
                                rows="3"
                            >

                            </textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        Close
                    </button>

                    <button
                        type="button"
                        class="btn btn-primary"
                        id="modal-save"
                    >
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var postId = ''
        var token = '{{ Session::token() }}'
        var urlEdit = '{{ route('edit') }}'
        var postContentElement = null

        $('.edit-post').on('click', function(e) {
            e.preventDefault()

            postContentElement = event.target.parentNode.parentNode.childNodes[1]

            var postContent = postContentElement.textContent
            postId = event.target.parentNode.parentNode.parentNode.dataset['postid']

            $('#modal-post_content').val(postContent)
            $('#edit-modal').modal()
        })

        $('#modal-save').on('click', function(e) {
            e.preventDefault()

            var modalPostContent = $('#modal-post_content').val()

            $.ajax({
                    method: 'POST',
                    header: {
                        'X-CSRF-TOKEN': token
                    },
                    url: urlEdit,
                    data: {
                        modalPostContent: $('#modal-post_content').val(),
                        postId: postId,
                        _token: token
                    }
                })
                .done(function (msg) {
                    $(postContentElement).text(msg['newPost']);
                    $('#edit-modal').modal('hide');
                })
        })
    </script>
@endsection
