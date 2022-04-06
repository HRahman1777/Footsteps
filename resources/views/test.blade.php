@extends('layouts.app')

@section('content')
    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <div class="container">

        @foreach ($posts as $item)
            {{ $item->title }}
            <br>
            @foreach ($item->tags as $i)
                {{ $i->name }},
            @endforeach
            <br>
            <br>
        @endforeach
        <hr>
        @foreach ($tags as $item)
            {{ $item->name }},
        @endforeach
        <hr>


    </div>
@endsection
