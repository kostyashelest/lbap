@extends('layouts.default')
@section('content')
    <div class="mb-2 mb-xl-3 row">
        <div class="d-none d-sm-block col-auto"><h3>{{ __('title.main.title') }}</h3></div>
    </div>

    <div class="row">
        <div class="d-flex col-xl col-md-6">
            <div class="illustration flex-fill card">
                <div class="p-0 d-flex flex-fill card-body">
                    <div class="g-0 w-100 row">
                        <div class="col-12">
                            <div class="illustration-text p-3 m-1">
                                <h4 class="illustration-text">{{ __('title.welcome_back') }}!</h4>
                                <p class="mb-0">{{ __('title.description_title') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex col-xl col-md-6">
            <div class="flex-fill card">
                <div class=" py-4 card-body">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">$ 24.300</h3>
                            <p class="mb-2">Total Earnings</p>
                            <div class="mb-0">
                                <span class="badge-soft-success me-2 badge">+5.35%</span>
                                <span class="text-muted">Since last week</span>
                            </div>
                        </div>
                        <div class="d-inline-block ms-3">
                            <div class="stat">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="align-middle text-success">
                                    <line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex col-xl col-md-6">
            <div class="flex-fill card">
                <div class=" py-4 card-body">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">43</h3>
                            <p class="mb-2">Pending Orders</p>
                            <div class="mb-0">
                                <span class="badge-soft-danger me-2 badge">-4.25%</span>
                                <span class="text-muted">Since last week</span>
                            </div>
                        </div>
                        <div class="d-inline-block ms-3">
                            <div class="stat">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="align-middle text-success">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex col-xl col-md-6">
            <div class="flex-fill card">
                <div class=" py-4 card-body">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">$ 18.700</h3>
                            <p class="mb-2">Total Revenue</p>
                            <div class="mb-0">
                                <span class="badge-soft-success me-2 badge">+8.65%</span>
                                <span class="text-muted">Since last week</span>
                            </div>
                        </div>
                        <div class="d-inline-block ms-3">
                            <div class="stat">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="align-middle text-success">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex-fill w-100 card">
        <div class="card-header">
            <div class="mb-0 card-title h5" tag="h5">{{ __('title.user.latest') }}</div>
        </div>
        <div class="flex-fill w-100 card">
            @include('admin.user.table')
        </div>
    </div>
@endsection
