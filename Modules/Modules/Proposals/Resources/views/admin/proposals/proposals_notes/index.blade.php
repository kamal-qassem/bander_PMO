@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @include('proposals::admin.proposals.invoice.invoice-menu', ['invoice' => $proposal])
    
    <h3 class="page-title">@lang('global.proposals-notes.title')</h3>
    @can('proposals_note_create')
    <p>
        <a href="{{ route('admin.proposals_notes.create', $proposal->id) }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <?php
             $count = Modules\Proposals\Entities\ProposalsNote::where('proposal_id', '=',$proposal->id )->count();
            ?>
            <li><a href="{{ route('admin.proposals_notes.index', $proposal->id) }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')<span class="badge">{{$count}}</span></a></li>@can('proposals_note_delete') |
                <?php
                 $trash_count = Modules\Proposals\Entities\ProposalsNote::where('proposal_id', '=',$proposal->id )->onlyTrashed()->count();
                ?> 
            <li><a href="{{ route('admin.proposals_notes.index', $proposal->id) }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')<span class="badge">{{$trash_count}}</span></a></li>
            @endcan
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('proposals_note_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('proposals_note_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.proposals-notes.fields.description')</th>
                        <th>@lang('global.invoice-notes.fields.created-by')</th>
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
        @can('proposals_note_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.proposals_notes.mass_destroy', $proposal->id) }}'; @endif
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptionsNew.ajax.url = '{!! route('admin.proposals_notes.index', $proposal->id) !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptionsNew.columns = [@can('proposals_note_delete')
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan{data: 'description', name: 'description'},
                {data: 'created_by.name', name: 'created_by.name'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTablesNew();
        });
    </script>
@endsection