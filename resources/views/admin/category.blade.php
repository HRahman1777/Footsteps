@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="text-secondary px-4 py-5 text-center shadow" style="background: #65b1fdf2">
            <div class="py-3">
                <h3 class="display-5 fw-bold text-white">Category Control</h3>
                <a href="{{ route('admin.home') }}" class="btn btn-sm btn-outline-dark">Admin Home</a>
            </div>
        </div>
        <hr>

        <form action="{{ route('add.category') }}" method="post">
            @csrf
            <label for="name" class="form-label">Category Name</label>
            <div class="gap-2 d-flex">
                <input type="text" name="name" class="form-control w-25" required>
                <button type="submit" class="btn btn-outline-secondary btn-sm">Add</button>
            </div>
        </form>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Post ID</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->name }}</td>
                        <td>-</td>
                        <td>
                            <a type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $item->id }}">Edit</a>
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/admin/category/{{ $item->id }}/edit" method="post">
                                                @csrf
                                                <label for="name" class="form-label">Category Name</label>
                                                <div class="gap-2 d-flex">
                                                    <input type="text" name="name" value="{{ $item->name }}"
                                                        class="form-control w-25" required>
                                                    <button type="submit"
                                                        class="btn btn-outline-secondary btn-sm">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
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
                                            <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
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
                                                href="/admin/category/{{ $item->id }}/delete">Delete</a>
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
                timer: 1500
            });
        </script>
    @endif
@endsection
