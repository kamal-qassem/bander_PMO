@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('templates::global.templates.title')</h3>
    @can('template_create')
    <p>
        <a href="{{ route('admin.templates.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.templates.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')
                <span class="badge"> 
            
               {{\Modules\Templates\Entities\Template::count()}}
           
                
            </span>
            </a></li>
            @can('template_delete') |
            <li><a href="{{ route('admin.templates.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')
            <span class="badge"> 
           
               {{\Modules\Templates\Entities\Template::onlyTrashed()->count()}}
                       </span>

            </a></li>
            @endcan
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('template_delete_multi') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('template_delete_multi')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('templates::global.templates.fields.key')</th>
                        <th>@lang('templates::global.templates.fields.type')</th>
                        <th>@lang('templates::global.templates.fields.subject')</th>
                        <th>@lang('templates::global.templates.fields.from-email')</th>
                        <th>@lang('templates::global.templates.fields.from-name')</th>
                        
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop


@section('javascript') 
    <script>
        @can('template_delete_multi')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.templates.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.templates.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [@can('template_delete_multi')
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan{data: 'key', name: 'key'},
                {data: 'type', name: 'type'},
                {data: 'subject', name: 'subject'},
                {data: 'from_email', name: 'from_email'},
                {data: 'from_name', name: 'from_name'},
                
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection