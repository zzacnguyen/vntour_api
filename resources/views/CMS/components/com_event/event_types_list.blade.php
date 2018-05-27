@extends('CMS.components.index')
@section('content')

<div id="page-title">
    <h2>Danh sách loại hình sự kiện <div style="float: right;">
        <a href="{{ route('_GETVIEW_ADD_TYPES_EVENT') }}" class="btn btn-primary">Thêm mới</a>
</div></h2>
    {{-- <p>Dưới đây là dữ liệu tất cả địa điểm hiện có.</p> --}}

</div>

<div class="clearfix"></div>
<div class="panel">
    <div class="panel-body">
    <h3 class="title-hero">
        DANH SÁCH ĐIỂM
    </h3>
        <div class="example-box-wrapper">
            <table id="datatable-reorder" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    
                    <th>ID</th>
                    <th style="width: 80%">Tên loại hình</th>
                    <th>Trạng thái</th>
                </tr>
                </thead>

                <tfoot>
                <tr>
                    <th>ID</th>
                    <th style="width: 80%">Tên loại hình</th>
                    <th>Trạng thái</th>
                </tr>
                </tfoot>
                <tbody>                 
                    @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><a href="{{ route('_GETVIEW_EDIT_EVENT_TYPES', $item->id ) }}">{{ $item->type_name }}</a></td>
                        {{-- <td>{{ $item->type_name }}</td> --}}
                        <td> 
                            @if($item->type_status == 1)
                                <p class="bg-info">Hiển thị</p>
                            @else
                                <p class="bg-danger">Đã tắt</p>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $data->render() !!}
        </div>
    </div>
</div>




@endsection