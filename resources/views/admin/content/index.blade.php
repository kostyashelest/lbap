@extends('layouts.default', ['title' => __('title.content.many')])
@section('content')
    <div class="mb-2 mb-xl-3 d-flex justify-content-between">
        <div class="">
            <h3>{{ __('title.content.many') }}</h3>
        </div>
        <div class="topButton">
            <a href="{{ Route('admin.content.create') }}">
                <button type="submit" class="btn btn-sm btn-outline-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-plus align-middle me-2"
                    >
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    {{ __('title.btn.create') }}
                </button>
            </a>
        </div>
    </div>
    <div class="filters row">
        <div class="col-12 col-md-6 col-xl-4 col-xxl-3">
            <form class="input-group shadow-sm search input-group-navbar" action="" method="get">
                <input
                    type="text"
                    name="title"
                    value="{{ request('title') }}"
                    class="form-control"
                    placeholder="{{ __('title.content.title') }}"
                    aria-label="{{ __('title.content.title') }}"
                >
                <button class="btn" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-search align-middle"
                    >
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
            </form>
        </div>
    </div>
    <div class="flex-fill w-100 card table-responsive users">
        <table class="my-0 table table-striped users">
            <thead>
            <tr>
                <th>@sortablelink('id',  __('title.id'))</th>
                <th>{{ __('title.content.title') }}</th>
                <th>{{ __('title.content.preview') }}</th>
                <th>{{ __('title.content.delayed_publication') }}</th>
                <th>@sortablelink('created_at',  __('title.created_at'))</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach ($contents as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->preview }}</td>
                    <td>{{ $item->delayed_time_publication }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td class="text-center">
                        <a href="{{ Route('admin.content.edit', $item) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather align-middle me-2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
                        <a data-bs-toggle="modal" data-bs-target="#deleteModal_{{ $item->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather align-middle me-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                    </td>
                </tr>
                @include('includes.delete-modal', ['id' => 'deleteModal_'.$item->id, 'action' => Route('admin.content.destroy', $item)])
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="paginationBlock">
        {{ $contents->appends(request()->query())->links('includes.pagination') }}
    </div>
@endsection
