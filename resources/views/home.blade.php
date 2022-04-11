@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-9">
                <div class="mt-2">
                    <p>
                        <a class="btn btn-outline-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            Create Post
                        </a>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <form method="POST" action="{{ route('posted') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="category" class="form-label">{{ __('Category') }}</label>
                                    <select class="form-select px-2 bg-light" required name="category" id="category"
                                        aria-label="Default select example">
                                        @foreach ($categories as $category)
                                            <option value={{ $category->id }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                    <label for="title" class="form-label">{{ __('Title') }}</label>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="description" id="body" class="form-control @error('body') is-invalid @enderror"
                                        value="{{ old('body') }}" autocomplete="body" autofocus
                                        style="height: 240px"></textarea>
                                    <label for="body" class="form-label">{{ __('Description') }}</label>
                                </div>
                                <div class="mb-3">
                                    <label for="tag" class="form-label">{{ __('Tags') }}</label>
                                    <input name='tags' value='' class="form-control" autofocus data-blacklist=''>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">{{ __('Picture') }}</label>
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror"
                                        name="image" onchange="readURL(this)" value="{{ old('image') }}">
                                    @error('image')
                                        <strong class="text-danger">Invalid Picture (please upload jpg,png,jpeg below 5mb
                                            size)</strong>
                                    @enderror
                                    <img id="pre_image" class="img-thumbnail mt-1" src="" alt="" />
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-outline-info">Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @foreach ($posts as $post)
                    <div class="card bg-light px-4 py-2 mt-3 shadow">
                        <h5>{{ $post->user->name }}</i></h5>
                        <small>
                            <p class="text-muted text-sm mb-0">
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
                            }
                            ?>
                            <img src="{{ asset('upload/images/' . $post->image) }}"
                                class="mt-1 rounded float-start img-fluid mb-2"
                                style="max-height: {{ $new_height }}rem; max-width: {{ $new_width }}rem" alt="">
                        @endif
                        <a class="btn btn-outline-secondary btn-sm w-50" href="/explore/{{ $post->id }}"><b>View /
                                Comment</b></a>
                    </div>
                @endforeach
                <a class="btn btn-outline-dark mt-4" href="{{ route('all.post') }}">
                    <span>Explore More</span>
                    <span class="bi bi-arrow-right-circle-fill"></span>
                </a>
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
    <script>
        // for image preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#pre_image')
                        .attr('src', e.target.result)
                        .width(140)
                        .height(140);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // tagify for tags suggestion
        var tag_array = {!! json_encode($tag_array) !!};
        var inputElm = document.querySelector('input[name=tags]'),
            whitelist = tag_array;

        var tagify = new Tagify(inputElm, {
            enforceWhitelist: true,
            whitelist: inputElm.value.trim().split(/\s*,\s*/)
        })

        tagify.on('add', onAddTag)
            .on('remove', onRemoveTag)
            .on('input', onInput)
            .on('edit', onTagEdit)
            .on('invalid', onInvalidTag)
            .on('click', onTagClick)
            .on('focus', onTagifyFocusBlur)
            .on('blur', onTagifyFocusBlur)
            .on('dropdown:hide dropdown:show', e => console.log(e.type))
            .on('dropdown:select', onDropdownSelect)

        var mockAjax = (function mockAjax() {
            var timeout;
            return function(duration) {
                clearTimeout(timeout);
                return new Promise(function(resolve, reject) {
                    timeout = setTimeout(resolve, duration || 700, whitelist)
                })
            }
        })()

        function onAddTag(e) {
            console.log("onAddTag: ", e.detail);
            console.log("original input value: ", inputElm.value)
            tagify.off('add', onAddTag) // exmaple of removing a custom Tagify event
        }

        function onRemoveTag(e) {
            console.log("onRemoveTag:", e.detail, "tagify instance value:", tagify.value)
        }

        function onInput(e) {
            console.log("onInput: ", e.detail);
            tagify.settings.whitelist.length = 0;
            tagify.loading(true).dropdown.hide.call(tagify)

            mockAjax()
                .then(function(result) {
                    tagify.settings.whitelist.push(...result, ...tagify.value)
                    tagify.loading(false).dropdown.show.call(tagify, e.detail.value);
                })
        }

        function onTagEdit(e) {
            console.log("onTagEdit: ", e.detail);
        }

        function onInvalidTag(e) {
            console.log("onInvalidTag: ", e.detail);
        }

        function onTagClick(e) {
            console.log(e.detail);
            console.log("onTagClick: ", e.detail);
        }

        function onTagifyFocusBlur(e) {
            console.log(e.type, "event fired")
        }

        function onDropdownSelect(e) {
            console.log("onDropdownSelect: ", e.detail)
        }
    </script>
@endsection
