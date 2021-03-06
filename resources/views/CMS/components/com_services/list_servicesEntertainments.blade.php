@extends('CMS.components.index')
@section('content')

<div id="page-title">
    <h2>Danh sách dịch vụ</h2>
    <p>Dưới đây là dữ liệu dịch vụ Vui chơi giải trí.</p>

</div>
<div class="panel">
    <div class="panel-body">
    <h3 class="title-hero">
        DANH SÁCH DỊCH VỤ
    </h3>
        <div class="example-box-wrapper">
            <table id="datatable-reorder" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Tên dịch vụ</th>
                    <th>Mở cửa</th>
                    <th>Số điện thoại</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Tên dịch vụ</th>
                    <th>Mở cửa</th>
                    <th>Giá</th>
                    <th>Chỉnh sửa lần cuối</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                </tr>
                </tfoot>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td><a href="{{ route('_SERVICE_DETAILS', $item->id) }}">
                            @if($item->entertainments_name != null)
                                -{{ $item->entertainments_name }}
                            @endif
                            </a>
                        </td>
                        <td>Từ {{ $item->sv_open }} đến {{ $item->sv_close }}</td>
                        <td>{{ $item->sv_phone_number }} </td>
                        <td style="text-align: center;">
                            <?php if($item->sv_highest_price == 0) echo "Đang cập nhật";  else echo "Từ:" . $item->sv_lowest_price." đến ".  $item->sv_highest_price; ?>
                        </td>
                        <td>
                            {{-- <a href="{{  route('EDIT_STATUS_UNACTIVE_SERVICES', $item->id)}}"><i class="fa fa-edit"></i> --}}
                                <?php  
                                   if($item->sv_status == 1)
                                   {
                                        echo '<small class="label-success">Hiển thị</small>' ;
                                   }
                                   else if($item->sv_status == 0)
                                   {
                                        echo '<small class="label-warning">Chờ duyệt</small>' ;
                                   }
                                   else if ($item->sv_status == -1 )
                                   {
                                        echo '<small class="label-danger">Spam</small>' ;
                                   }
                                   else
                                   {
                                        echo "";
                                   }

                                ?> 
                                {{-- </a> --}}
                        </td>
                            
                        <td>{{ $item->updated_at }} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $data->render() !!}
        </div>
    </div>
</div>




@endsection