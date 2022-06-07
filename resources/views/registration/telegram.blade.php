@extends('layouts.auth')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h5" tag="h5">{{ __('title.registration.telegram') }}</div>

                    <a href="{{ $url }}">Telegram bot</a>
                </div>
            </div>
        </div>
    </div>
@endsection
