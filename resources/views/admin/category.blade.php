@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="text-secondary px-4 py-5 text-center shadow" style="background: #65b1fdf2">
            <div class="py-3">
                <h3 class="display-5 fw-bold text-white">Category Controll</h3>
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
                            <a href="/admin/category/{{ $item->id }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="/admin/category/{{ $item->id }}/delete" class="btn btn-sm btn-danger">Delete</a>
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
