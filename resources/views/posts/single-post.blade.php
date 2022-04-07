@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($post)
            <div class="card bg-light px-4 py-2 mt-3 shadow">
                <h4 class="mb-0">{{ $post->user->name }}</i></h4>
                <small>
                    <p class="text-muted text-sm mt-0">
                        @<i>{{ $post->user->username }}</i> -
                        {{ $post->updated_at }}
                    </p>
                    <h5><b>{{ $post->title }}</b></h5>
                    <div class="gap-2 d-flex">
                        <a href="/explore?catId={{ $post->category->id }}"
                            class="catLink border p-1 rounded">{{ $post->category->name }}</a>
                        -
                        @foreach ($post->tags as $tag)
                            <p class="border p-1 rounded">#{{ $tag->name }}</p>
                        @endforeach
                    </div>
                </small>
                <p>{{ $post->body }}</p>
                @if ($post->image != null)
                    <img src="{{ asset('upload/images/' . $post->image) }}" class="mt-1 rounded float-start img-fluid mb-2"
                        alt="">
                @endif
            </div>
            <div class="card bg-light px-4 py-2 mt-3 shadow">
                <h4>Comments</h4>
                <p>
                    <a class="btn btn-outline-primary btn-sm" data-bs-toggle="collapse" href="#collapseExample" role="button"
                        aria-expanded="false" aria-controls="collapseExample">
                        Add Comment
                    </a>
                </p>
                <div class="collapse" id="collapseExample">
                    <form action="/explore/{{ $post->id }}" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <textarea name="comment" id="comment" class="form-control @error('comment') is-invalid @enderror"
                                value="{{ old('comment') }}" required autocomplete="comment" autofocus
                                style="height: 80px"></textarea>
                            <label for="comment" class="form-label">{{ __('Comment') }}</label>
                        </div>
                        <button type="submit" class="btn btn-outline-success btn-sm">Comment</button>
                    </form>
                </div>
                <hr>

                @foreach ($post->comments as $item)
                    <div class="mb-4">
                        <h5 class="">{{ $item->user->name }} - <span
                                class="text-muted"><i>{{ $item->user->username }}</i></span>
                        </h5>
                        <p class="p-2 mb-0 rounded" style="background-color: rgba(217, 234, 249, 0.829)">
                            {{ $item->comment }}
                        </p>
                        @if (Auth::user()->username == $item->user->username)
                            <div class="gap-2 d-flex justify-content-end">
                                <a href="" class="">Edit</a> - <a type="button" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $item->id }}">Delete</a>
                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Delete Comment</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are You Sure ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a type="button" class="btn btn-danger"
                                                    href="/explore/{{ $post->id }}/{{ $item->id }}/delete">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
        @if (!$post)
            <h1 class="pt-5 mt-4"><i>No Post Available....</i></h1>
        @endif

    </div>
@endsection

@section('script')
    @if (Session::has('jervis'))
        <script>
            const jervis = {!! json_encode(Session::get('jervis')) !!};
            Swal.fire({
                position: 'top-end',
                icon: jervis.status,
                title: jervis.message,
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
@endsection
