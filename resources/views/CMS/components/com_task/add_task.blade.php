
<script type="text/javascript" language="javascript">
  $(document).ready(function() {

    console.log("CHẠY TỚI ĐÂY");
    $(document).ready(function() {
        //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
        $("#frm_add_task").validate({
            rules: {
                task_name: "required",
                task_description: "required",
                task_start_date:"required",
                task_end_date:"required",
                content:"required"
            },
            messages: {
                task_name: "Vui lòng nhập tên nhiệm vụ",
                task_description: "Vui lòng nhập mô tả nhiệm vụ",   
                task_start_date:"Vui lòng nhập vào ngày bắt đầu nhiệm vụ",
                task_end_date: "Vui lòng nhập vào ngày kết thúc nhiệm vụ",
                content:"Vui lòng nhập vào nội dung nhiệm vụ"
            }
        });
    }); });
</script>
<div class="row" style="padding-top: 25px;">
    <h2>Thêm nhiệm vụ mới</h2>
    <div class="content-box bg-white post-box">
        <form id="frm_add_task" name="frm_add_task" action="" method="post"  enctype="multipart/form-data"  >
            
            <div class="col-md-12 form-group" style="padding-top: 20px" >
                <div class="col-md-6">
                    <label for="task_name">Tên nhiệm vụ: </label>
                    <input type="text" id="task_name" required  class="form-control" name="task_name" >
                </div>
                 <div class="col-md-6">
                    <label for="task_description" >Mô tả: </label>
                    <input type="text" id="task_description" required class="form-control" name="task_description" >
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 form-group" style="padding-top: 20px" >
                <div class="col-md-6">
                    <label for="task_start_date">Ngày bắt đầu: </label>
                    <input type="date" id="task_start_date" required class="form-control" name="task_start_date" > 
                </div>
                <div class="col-md-6">
                    <label for="task_end_date">Ngày kết thúc: </label>
                    <input type="date" id="task_end_date" required class="form-control" name="task_end_date" > 
                 </div>
                 <div class="col-md-12 form-group" style="padding-top: 20px" >
                    <label for="content" >Nội dung chi tiết: </label>
                    <textarea name="content" class="form-control" required`     id="content" style="border: 1px solid #e1e1e1"  class="textarea-autosize" placeholder="Bạn đang cần làm việc gì?"></textarea>
                    <div class="clearfix"></div>
                </div>
            </div>
             <input  class="btn btn-success" style="margin-bottom: 20px; margin-left: 90%" type="submit" value="Xong">
        </form>
    </div>
</div>