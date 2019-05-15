@inject('statusesService', 'InetStudio\StatusesPackage\Statuses\Contracts\Services\Back\ItemsServiceContract')

@php
    $item = $value;

    $status = (! $item->id or ! $item->status) ? $statusesService->getAllItems()->first() : $item->status;
@endphp

<button class="btn btn-sm btn-{{ $status->color_class }}">{{ $status->name }}</button>
