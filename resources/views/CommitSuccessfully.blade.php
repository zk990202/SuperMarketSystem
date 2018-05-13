@extends('layouts.main')

@section('content')
    <div class="box">
        <div class="callout callout-info">
            <h4>{{ $title }}</h4>

            <p>{{ $message }}</p>

            <button class="btn btn-primary">
                <a href="{{ $url }}">{{ $url_message }}</a>
            </button>
        </div>
        <!-- /.box-body -->
    </div>
@endsection