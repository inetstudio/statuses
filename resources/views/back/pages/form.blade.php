@extends('admin::back.layouts.app')

@php
    $title = ($item->id) ? 'Редактирование статуса' : 'Добавление статуса';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.statuses::back.partials.breadcrumbs')
        <li>
            <a href="{{ route('back.statuses.index') }}">Статусы</a>
        </li>
    @endpush

    <div class="row m-sm">
        <a class="btn btn-white" href="{{ route('back.statuses.index') }}">
            <i class="fa fa-arrow-left"></i> Вернуться назад
        </a>
        @if ($item->id && $item->href)
            <a class="btn btn-white" href="{{ $item->href }}" target="_blank">
                <i class="fa fa-eye"></i> Посмотреть на сайте
            </a>
        @endif
    </div>

    <div class="wrapper wrapper-content">

        {!! Form::info() !!}

        {!! Form::open(['url' => (!$item->id) ? route('back.statuses.store') : route('back.statuses.update', [$item->id]), 'id' => 'mainForm', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}

            @if ($item->id)
                {{ method_field('PUT') }}
            @endif

            {!! Form::hidden('status_id', (!$item->id) ? '' : $item->id) !!}

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel-group float-e-margins" id="mainAccordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#mainAccordion" href="#collapseMain" aria-expanded="true">Основная информация</a>
                                </h5>
                            </div>
                            <div id="collapseMain" class="panel-collapse collapse in" aria-expanded="true">
                                <div class="panel-body">

                                    {!! Form::string('name', $item->name, [
                                        'label' => [
                                            'title' => 'Название',
                                        ],
                                    ]) !!}

                                    {!! Form::string('alias', $item->alias, [
                                        'label' => [
                                            'title' => 'Алиас',
                                        ],
                                    ]) !!}

                                    {!! Form::wysiwyg('description', $item->description, [
                                        'label' => [
                                            'title' => 'Описание',
                                        ],
                                        'field' => [
                                            'class' => 'tinymce-simple',
                                            'type' => 'simple',
                                            'id' => 'description',
                                        ],
                                    ]) !!}

                                    {!! Form::dropdown('color_class', (! $item->id) ? 'default' : $item->color_class, [
                                        'label' => [
                                            'title' => 'Цветовое обозначение',
                                        ],
                                        'field' => [
                                            'class' => 'select2 form-control',
                                            'data-placeholder' => 'Выберите цвет',
                                            'style' => 'width: 100%',
                                        ],
                                        'options' => [
                                            'values' => [
                                                null => '',
                                                'default' => 'default',
                                                'primary' => 'primary',
                                                'success' => 'success',
                                                'info' => 'info',
                                                'warning' => 'warning',
                                                'danger' => 'danger',
                                            ],
                                        ],
                                    ]) !!}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::buttons('', '', ['back' => 'back.statuses.index']) !!}

        {!! Form::close()!!}
    </div>
@endsection
