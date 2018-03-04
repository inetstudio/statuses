@inject('statusesService', 'InetStudio\Statuses\Contracts\Services\Back\StatusesServiceContract')

@php
    $item = $value;
@endphp

{!! Form::dropdown('status_id', $item->status_id, [
    'label' => [
        'title' => 'Статус материала',
    ],
    'field' => [
        'class' => 'select2 form-control',
        'data-placeholder' => 'Выберите статус',
        'style' => 'width: 100%',
    ],
    'options' => [
        'values' => [null => ''] + $statusesService->getAllStatuses(true)->pluck('name', 'id')->toArray(),
    ],
]) !!}
