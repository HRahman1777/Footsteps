@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="text-secondary px-4 py-5 text-center shadow" style="background: #65b1fdf2">
            <div class="py-5">
                <h3 class="display-5 fw-bold text-white">Let's Grow Together !</h3>
                <div class="col-lg-6 mx-auto">
                    <p class="fs-5 mb-4">
                    </p>
                    <h1>Welcome to ADMIN control</h1>
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <a type="button" href="" class="btn btn-outline-dark btn-lg px-4 me-sm-3 fw-bold">User</a>
                        <a type="button" href="{{ route('admin.category') }}"
                            class="btn btn-outline-dark btn-lg px-4 me-sm-3 fw-bold">Category</a>
                        <a type="button" href="" class="btn btn-outline-dark btn-lg px-4 me-sm-3 fw-bold">Tag</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
