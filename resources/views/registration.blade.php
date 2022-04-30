@extends('layouts.auth')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h5" tag="h5">{{ __('title.registration.title') }}</div>

                    <form method="POST" action="{{ Route('registration.store') }}" class="">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">{{ __('title.input.email') }}</label>
                            <input name="email" placeholder="{{ __('title.input.email') }}" type="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('title.input.password') }}</label>
                            <input name="password" placeholder="{{ __('title.input.password') }}" type="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('title.input.repeat_password') }}</label>
                            <input name="repeat_password" placeholder="{{ __('title.input.repeat_password') }}" type="password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('title.btn.submit') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
