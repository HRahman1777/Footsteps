@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-9">
                <div class="mt-3 card card-body shadow p-3 mb-3 bg-body rounded">
                    <h4>Filter</h4>
                    <div class="row">
                        <div class="col-4">
                            <p>Select Category</p>
                            <form action="">
                                <select class="form-select" name="catId" onchange="this.form.submit()">
                                    <option>please select</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @isset($_GET['catId']) @if ($_GET['catId'] == $category->id) @selected(true) @endif @endisset>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="col">
                            <p>Search Keyword</p>
                            <form class="d-flex" action="">
                                <input class="form-control me-2" type="search" placeholder="search in title"
                                    aria-label="Search" name="sKey"
                                    @isset($_GET['sKey']) value={{ $_GET['sKey'] }} @endisset>
                                <button class="btn btn-outline-success btn-sm" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
                @if (count($posts) == 0)
                    <h3 class="text-center"><i>No Post Available</i></h3>
                @endif
                @foreach ($posts as $post)
                    <div class="card bg-light px-4 py-2 mt-3 shadow">
                        <h4 class="mb-0">{{ $post->user->name }}</i></h5>
                            <small>
                                <p class="text-muted text-sm mt-0">
                                    @<i>{{ $post->user->username }}</i> -
                                    {{ $post->updated_at }}
                                </p>
                                <h5><b>{{ $post->title }}</b></h5>
                                <div class="gap-2 d-flex">
                                    <a href="/explore?catId={{ $post->category->id }}"
                                        class="catLink border p-1 rounded">{{ $post->category->name }}</a> -
                                    @foreach ($post->tags as $tag)
                                        <p class="border p-1 rounded">#{{ $tag->name }}</p>
                                    @endforeach
                                </div>
                            </small>
                            <p>{{ $post->body }}</p>
                            @if ($post->image != null)
                                <?php
                            if (file_exists('upload/images/' . $post->image)) {
                                $imageInfo = getimagesize('upload/images/' . $post->image);
                                $width = $imageInfo[0];
                                $height = $imageInfo[1];
                                if ($height > $width) {
                                    $ratio = $height / $width;
                                    $new_height = 25;
                                    $new_width = round(25 / $ratio);
                                } else {
                                    $ratio = $width / $height;
                                    $new_width = 25;
                                    $new_height = round(25 / $ratio);
                                }?>
                                <img src="{{ asset('upload/images/' . $post->image) }}"
                                    class="mt-1 rounded float-start img-fluid mb-2"
                                    style="max-height: {{ $new_height }}rem; max-width: {{ $new_width }}rem" alt="">
                                <?php 
                            } else {
                                echo "Heroku don't store image for permanent";
                            }
                            ?>
                            @endif
                            <a class="btn btn-outline-secondary btn-sm w-50" href="/explore/{{ $post->id }}"><b>View /
                                    Comment</b></a>
                    </div>
                @endforeach
            </div>
            <div class="col">
                <div class="sticky-lg-top mt-2">
                    <div class="card mt-3">
                        <div class="card-header">{{ __('Following') }}</div>
                        <div class="card-body">
                            <ul>
                                <li><a href="">Person Name</a></li>
                                <li><a href="">Person Name</a></li>
                                <li><a href="">Person Name</a></li>
                                <li><a href="">Person Name</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">{{ __('Categories') }}</div>
                        <div class="card-body">
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a href="">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">{{ __('Top Post') }}</div>
                        <div class="card-body">
                            <ul>
                                @foreach ($posts as $post)
                                    <li><a href="">{{ $post->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
