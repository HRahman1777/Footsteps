@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="text-secondary px-4 py-5 text-center shadow" style="background: #65b1fdf2">
            <div class="py-5">
                <h3 class="display-5 fw-bold text-white">Let's Grow Together !</h3>
                <div class="col-lg-6 mx-auto">
                    <p class="fs-5 mb-4">
                    </p>
                    @guest
                        @if (Route::has('login') || Route::has('register'))
                            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                                <a type="button" href="{{ route('login') }}"
                                    class="btn btn-outline-dark btn-lg px-4 me-sm-3 fw-bold">Login!</a>
                                <a type="button" href="{{ route('register') }}"
                                    class="btn btn-outline-dark btn-lg px-4 me-sm-3 fw-bold">Register!</a>
                            </div>
                        @endif
                    @else
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            <a type="button" href="{{ route('login') }}"
                                class="btn btn-outline-dark btn-lg px-4 me-sm-3 fw-bold">Explore!</a>
                            <a type="button" href="{{ route('register') }}"
                                class="btn btn-outline-dark btn-lg px-4 me-sm-3 fw-bold">Create Post!</a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
@endsection
