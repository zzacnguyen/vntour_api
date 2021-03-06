@extends('CMS.components.index')
@section('content')


<div id="page-title">
    <h2>Danh sách người dùng</h2>
    
    <div id="theme-options" class="admin-options">
        <a href="javascript:void(0);" class="btn btn-primary theme-switcher tooltip-button" data-placement="left" title="Color schemes and layout options">
            <i class="glyph-icon icon-linecons-cog icon-spin"></i>
        </a>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
    <h3 class="title-hero">
        HƯỚNG DẪN VIÊN DU LỊCH
    </h3>
        <div class="example-box-wrapper">
            <table id="datatable-reorder" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>User name</th>
                    <th>Login social ID</th>
                    <th>Name</th>
                    <th>Phone number</th>
                   
                    <th>Được duyệt</th>
                    <th>Thao tác</th>
                </tr>
                </thead>

                <tfoot>
                <tr>
                    <th>User name</th>
                    <th>Login social ID</th>
                    <th>Name</th>
                    <th>Phone number</th>
                   
                    <th>Được duyệt</th>
                    <th>Thao tác</th>
                </tr>
                </tfoot>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->social_login_id }}</td>
                        <td>{{ $item->contact_name }}</td>
                        <td>{{ $item->contact_phone }}</td>
                       
                        <td> <?php if($item->account_active == 1)  
                                echo "Được duyệt";
                                 else 
                                 echo "Chưa duyệt"; ?> </td>
                        <td><a href="{{ route('ACCTIVE_TOURGUIDE', $item->user_id) }}">
                            <i class="glyph-icon tooltip-button demo-icon icon-bolt bg-success"></i>
                        </a>
                           <a data-toggle="modal"   data-target="#removeUser{{ $item->user_id }}"> <i title="Tắt chức năng của hướng dẫn viên du lịch" class="glyph-icon tooltip-button demo-icon icon-warning bg-danger"></i></a>
                            <div aria-labelledby="myModalLabel" class="modal fade" id="removeUser{{ $item->user_id }}" role="dialog" tabindex="-1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Bạn có chắc chắn?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p style="color:red">Sau khi nhấn đồng ý, Hướng dẫn viên du lịch  <b>{{ $item->contact_name }}</b> <small>({{ $item->contact_name }})</small>  sẽ bị tắt một số chức năng của hướng dẫn viên du lịch!</p>
                                            <small> Lưu ý: Dữ liệu sẽ không bị xoá! </small>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default" data-dismiss="modal" type="button">Hủy bỏ</button>
                                            <a class="btn btn-danger" href="{{ route('UNACCTIVE_TOURGUIDE', $item->user_id) }}" id="remove-button" type="submit">Đồng ý</a>
                                            {{-- <a href="javascript:void(0)" class="btn btn-danger">ĐỒNG Ý</a> --}}
                                        </div>
                                    </div><!-- end modal-content -->
                                </div><!-- end modal-dialog -->
                            </div><!-- end modal -->
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