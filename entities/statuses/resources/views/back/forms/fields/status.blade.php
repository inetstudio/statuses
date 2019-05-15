@inject('statusesService', 'InetStudio\StatusesPackage\Statuses\Contracts\Services\Back\ItemsServiceContract')

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
        'values' => [null => ''] + $statusesService->getAllItems()->pluck('name', 'id')->toArray(),
    ],
]) !!}
