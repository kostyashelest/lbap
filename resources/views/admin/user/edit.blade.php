@extends('layouts.default')
@section('content')
    <div class="mb-2 mb-xl-3 d-flex justify-content-between">
        <div class="">
            <h3>{{ __('title.user.title') }}</h3>
        </div>
        <div class="topButton">
            <a href="{{ Route('admin.user.index') }}">
                <button type="submit" class="btn btn-sm btn-outline-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-chevron-left align-middle me-2"
                    >
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                    {{ __('title.btn.return') }}
                </button>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="mb-0 card-title h5" tag="h5">{{ __('title.user.update') }}</div>
                </div>
                <div class="card-body">
                    <form class="" method="POST" action="{{ Route('admin.user.update', $user) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('title.email') }}</label>
                                            <input name="email" placeholder="Email" type="email" class="form-control"
                                                   value="{{ $user->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('title.created_at') }}</label>
                                            <input name="created_at" class="form-control"
                                                   value="{{ $user->created_at }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('title.tg') }}</label>
                                            <input name="telegram" class="form-control" value="{{ $user->telegram }}"
                                                   readonly>
                                        </div>
                                    </div>
                                    @if($user->referrer)
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('title.user.referrer') }}</label>
                                                <input name="referrer" class="form-control"
                                                       value="{{ $user->referrer }}" readonly>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('title.status') }}</label>
                                            {!! Form::select('status', \App\Enums\UserStatus::$list, $user->status, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('title.user.role') }}</label>
                                            <select class="roles form-control" multiple="multiple" name="roles[]">
                                                @foreach(\Spatie\Permission\Models\Role::all() as $role)
                                                    <option class="form-control"
                                                            value="{{ $role->id }}" {{ $user->roles->contains($role) ? 'selected' : '' }}>{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('title.user.file') }}</label>
                                            <input name="file" type="file" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            {{ __('title.btn.update') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="mb-0 card-title h5" tag="h5">{{ __('title.menu.files') }}</div>
                </div>
                <div class="card-body">
                    @include('admin.file.table')
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="mb-0 card-title h5" tag="h5">{{ __('title.menu.user_logs') }}</div>
                </div>
                <div class="card-body">
                    @include('admin.user.log.table')
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="mb-0 card-title h5" tag="h5">{{ __('title.user.referrals') }}</div>
                </div>
                <div class="card-body">
                    @include('admin.user.referral.table')
                </div>
            </div>
        </div>
    </div>
@endsection
