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
        'values' => [null => ''] + \InetStudio\Statuses\Models\StatusModel::select('id', 'name')->pluck('name', 'id')->toArray(),
    ],
]) !!}
