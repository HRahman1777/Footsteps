@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="text-secondary px-4 py-5 text-center shadow" style="background: #65b1fdf2">
            <div class="py-3">
                <h3 class="display-5 fw-bold text-white">Post Control</h3>
                <a href="{{ route('admin.home') }}" class="btn btn-sm btn-outline-dark">Admin Home</a>
            </div>
        </div>
        <hr>

        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Author</th>
                    <th scope="col">Title</th>
                    <th scope="col">Desc</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->user->username }}</td>
                        <td>{{ $item->title }}</td>
                        <td>
                            <div class="short-text-admin">{{ $item->body }}</div>
                        </td>
                        <td>{{ $item->image }}</td>
                        <td>
                            <a type="button" data-bs-toggle="modal" class="btn btn-warning btn-sm"
                                data-bs-target="#warningModal{{ $item->id }}">Warning</a>
                            <div class="modal fade" id="warningModal{{ $item->id }}" tabindex="-1"
                                aria-labelledby="warningModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="warningModalLabel">{{ $item->title }}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{ $item->body }}</p>
                                            @if ($item->image != null)
                                                <img src="{{ asset('upload/images/' . $item->image) }}"
                                                    class="img-thumbnail" alt="{{ $item->image }}">
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <a type="button" class="btn btn-warning" href="">Send</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a type="button" data-bs-toggle="modal" class="btn btn-danger btn-sm"
                                data-bs-target="#deleteModal{{ $item->id }}">Delete</a>
                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Delete Post</h5>
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
                                                href="/admin/post/{{ $item->id }}/delete">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
                timer: 1000
            });
        </script>
    @endif
@endsection
