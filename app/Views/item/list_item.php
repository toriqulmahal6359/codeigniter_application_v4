<?= $this->extend('layouts/front_end.php') ?>

<?= $this->section('content') ?>

<!-- Add Popup -->
<div class="modal fade" id="additemModal" tabindex="-1" aria-labelledby="additemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="additemModalLabel">Add Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <label for="">Brand<span style="color:red">*</span></label>
                <select name="brand_id" id="brand_id" class="form-control mt-2">
                    <option value="0">--Select Brand--</option>
                    <?php foreach($brand as $key=>$row){ ?>
                        <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                    <?php } ?>
                </select>
                <span id="error_brand" class="text-danger ms-2"></span>
            </div>
            <div class="form-group">
                <label for="">Model<span style="color:red">*</span></label>
                <select name="model_id" id="model_id" class="form-control mt-2">
                    <option value="0">--Select Model--</option>
                    <?php foreach($model as $key=>$row){ ?>
                        <option value="<?= $row['model_id']; ?>"><?= $row['model_name']; ?></option>
                    <?php } ?>
                </select>
                <span id="error_model" class="text-danger ms-2"></span>
            </div>
            <div class="form-group">
                <label for="">Item Name<span style="color:red">*</span></label>
                <input type="text" id="item_name" name="item_name" class="form-control mt-2">
                <span id="error_item_name" class="text-danger ms-2"></span>
            </div>
            <button type="button" class="btn btn-secondary my-2 add_new_item" id=item_add">Add</button>
      </div>
    </div>
  </div>
</div>

<!-- Update Popup -->
<div class="modal fade" id="edititemModal" tabindex="-1" aria-labelledby="edititemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edititemModalLabel">Edit Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <input type="hidden" id="item_id" name="item_id">
            <div class="form-group">
                <label for="">Brand<span style="color:red">*</span></label>
                <select name="brand_id_update" id="brand_id_update" class="form-control mt-2">
                    <option value="0">--Select Brand--</option>
                    <?php foreach($brand as $key=>$row){ ?>
                        <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                    <?php } ?>
                </select>
                <span id="error_brand_update" class="text-danger ms-2"></span>
            </div>
            <div class="form-group">
                <label for="">Model<span style="color:red">*</span></label>
                <select name="model_id_update" id="model_id_update" class="form-control mt-2">
                    <option value="0">--Select Model--</option>
                    <?php foreach($model as $key=>$row){ ?>
                        <option value="<?= $row['model_id']; ?>"><?= $row['model_name']; ?></option>
                    <?php } ?>
                </select>
                <span id="error_model_update" class="text-danger ms-2"></span>
            </div>
            <div class="form-group">
                <label for="">Item Name<span style="color:red">*</span></label>
                <input type="text" id="item_name_update" name="item_name_update" class="form-control mt-2">
                <span id="error_item_name_update" class="text-danger ms-2"></span>
            </div>
            <button type="button" class="btn btn-secondary my-2 update_item" id="item_update">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Popup -->
<div class="modal fade" id="deleteitemModal" tabindex="-1" aria-labelledby="deleteitemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteitemModalLabel">Delete Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <input type="hidden" id="item_id_del">
            <h6 class="text-center">Are You sure you want to Delete ?</h6>
            <div class="text-center">
                <button type="button" class="btn btn-success my-2 mx-6 delete_item" id="item_delete">OK</button>
                <button type="button" class="btn btn-danger my-2" data-bs-dismiss="modal">Cancel</button>
            </div>
      </div>
    </div>
  </div>
</div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Item Data</h4>
                    </div>
                    <div class="card-body">
                        <table class="col-md-12 table-bordered table-striped my-4">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Item</th>
                                    <th>Model Name</th>
                                    <th>Brand Name</th>
                                    <th>Entry Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="brand_data">
                                <?php foreach($item as $key=>$list): ?>

                                <tr>
                                    <td class="item_id"><?= $list['item_id'] ?></td>
                                    <td><?= $list['item_name'] ?></td>
                                    <td><?= $list['model_name']; ?></td>
                                    <td><?= $list['brand_name']; ?></td>
                                    <td><?=
                                        date("d-m-Y", strtotime($list['entry_date'])); ?>
                                    </td>
                                    <td>
                                        <a href="#"><i class="fa fa-pencil-square-o fa-lg text-secondary mx-2 edit-btn" aria-hidden="true"></i></a>
                                        <a href="#" ><i class="fa fa-trash-o fa-lg text-danger mx-2 del-btn" aria-hidden="true"></i></a>
                                    </td>
                                    <?php endforeach ?>
                                </tr>
                                
                            </tbody>
                        </table>
                        <a href="" data-bs-toggle="modal" data-bs-target="#additemModal" class="btn btn-primary float-end">Add Item</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    $(document).ready(function(){
        // loadBrand();

        $(document).on('click', '.edit-btn', function(){
            var item_id = $(this).closest('tr').find('.item_id').text();
            // alert(item_id);
            $.ajax({
                method: "POST",
                url: "item/edit_item",
                data: {
                    'id' : item_id,
                },
                success:function(response){
                    $.each(response, function(key, value){
                        console.log(response);
                        $('#item_id').val(value['id']);
                        $('#brand_id_update').val(value['brand_id']);
                        $('#model_id_update').val(value['model_id']);
                        $('#item_name_update').val(value['item']);
                        $('#edititemModal').modal('show');
                    });
                }
            });
        });
        
        $('#item_update').on('click', function(){

            var char_pattern = /^[a-zA-Z]*$/; 
            var brand_id = $('#brand_id_update').val();
            var model_id = $('#model_id_update').val();
            var item_name = $('#item_name_update').val();

            if($.trim(item_name).length == 0 || brand_id == '' || model_id == ''){
                if($.trim(item_name).length == 0){
                    error_name = "Item Name is mandatory !!!";
                    $('#error_item_name_update').text(error_name);
                }else if(brand_id == ''){
                    error_name = "Brand Name is mandatory !!!";
                    $('#error_brand_update').text(error_name);
                }else{
                    error_name = "Model Name is mandatory !!!";
                    $('#error_model_update').text(error_name); 
                }
            }else if($('#item_name_update').val().length >= 255){
                error_name = "Maximum Length is 255 !!!";
                $('#error_item_name_update').text(error_name);
            }else if(char_pattern.test(item_name)){
                error_name = "Should contain Characters !!!";
                $("#error_item_name_update").text(error_name);
            }else{
                var data = {
                    'item_id': $('#item_id').val(),
                    'brand_id_update' : $('#brand_id_update').val(),
                    'model_id_update' : $('#model_id_update').val(),
                    'item_name_update' : $('#item_name_update').val()
                };
                $.ajax({
                    method: "POST",
                    url: "item/update_item",
                    data: data,
                    success:function(response){
                        $.each(response, function(key, value){
                            console.log(response);
                            $('#edititemModal').modal('hide');
                            $('#edititemModal').find('input').val('');
                            //window.location.href = response.redirect;
                            alertify.set('notifier', 'position', 'bottom-left');
                            alertify.success(response.status);
                            window.location.replace('/item');
                            // $('.brand_data').html("");
                            // loadBrand();
                        })
                    }
                });
            }
        });
    });

    $(document).on('click', '.del-btn', function(){
        var item_id = $(this).closest('tr').find('.item_id').text();
        $('#item_id_del').val(item_id);
        $('#deleteitemModal').modal('show');
        
    });

    $('#item_delete').on('click', function(){
        var delete_id = $('#item_id_del').val();
        // alert(delete_id);
        $.ajax({
            method: "POST",
            url: "item/delete_item",
            data: {
                "item_id_del" : delete_id
            },
            success: function(response){
                console.log(response.data);
                $("#deleteitemModal").modal('hide');
                alertify.set('notifier', 'position', 'bottom-left');
                alertify.success(response.status);
                window.location.replace('/item');
            }
        });
    });

    // function loadBrand(){
    //     $.ajax({
    //         method: "GET",
    //         url: "/brand/fetch_brand",
    //         success: function(response){
    //             // console.log(response.brands);
    //             $.each(response.brands, function(key, value){
    //                 //console.log(value['name']);
    //                 $(".brand_data").append('<tr><td class="brand_id">'+value['id']+'</td><td>'+value['name']+'</td><td class="date_time">'+value['entry_date']+'</td><td><a href="#"><i class="fa fa-pencil-square-o fa-lg text-secondary mx-2 edit-btn" aria-hidden="true"></i></a><a href="#" ><i class="fa fa-trash-o fa-lg text-danger mx-2 del-btn" aria-hidden="true"></i></a></td></tr>');
    //             })
    //         }
    //     })
    // }
</script>
<script>
    $(document).ready(function(){
        $('.add_new_item').on('click', function(){
            var char_pattern = /^[a-zA-Z]*$/; 
            var item_name = $('#item_name').val();
            var brand_name = $('#brand_id').val();
            var model_name = $('#model_id').val();
            var check_item_name = $.trim(item_name);

            if($.trim(item_name).length == 0 || brand_name == '' || model_name == ''){
                if($.trim(item_name).length == 0){
                    error_name = "Item Name is mandatory !!!";
                    $('#error_item_name').text(error_name);
                }else if(brand_name == ''){
                    error_name = "Brand Name is mandatory !!!";
                    $('#error_brand').text(error_name);
                }else{
                    error_name = "Model Name is mandatory !!!";
                    $('#error_model').text(error_name);
                }
            }else if($('#item_name').val().length >= 255){
                error_name = "Maximum Length is 255 !!!";
                $('#error_item_name').text(error_name);
            }else if(char_pattern.test(item_name)){
                error_name = "Should contain Characters !!!";
                $("#error_item_name").text(error_name);
            }else if(check_item_name != '' && brand_name != '' && model_name != ''){
                var data = {
                    'brand_id' : $("#brand_id").val(),
                    'model_id' : $("#model_id").val(),
                    'item_name' : $("#item_name").val(),
                    'check_item_name': check_item_name
                };
                $.ajax({
                    method: "POST",
                    url: "/item/add_item",
                    data: data,
                    success:function(response){
                        if(response == "1"){
                            $("#error_item_name").text("Item is Already Exists");
                        }else{
                            $('#additemModal').modal('hide');
                            $('#additemModal').find('input').val('');
                            alertify.set('notifier', 'position', 'bottom-left');
                            alertify.success(response.status);
                            window.location.replace('/item');
                            // $('.brand_data').html("");
                            // loadBrand();
                        }
                     
                    }
                })
            }

            // if($.trim(brand_name).length >= 51){
            //     error_name = "Maximum Length is 50 !!!";
            //     $('#error_name').text(error_name);
            // }else{
            //     error_name = '';
            //     $('#error_name').hide();
            // }

            // if(char_pattern.test(brand_name)){
            //     error_name = '';
            //     $('#error_name').hide();
            // }else{
            //     error_name = "Should contain Characters !!!";
            //     $("#error_name").text(error_name);
            // } 

            // if(error_name != ''){
            //     return false;
            // }else{
            //     var data = {
            //         'name' : $("#name").val()
            //     };
            //     $.ajax({
            //         method: "POST",
            //         url: "/brand/add_brand",
            //         data: data,
            //         success:function(response){
            //             $('#addbrandModal').modal('hide');
            //             $('#addbrandModal').find('input').val('');
            //             alertify.set('notifier', 'position', 'bottom-left');
            //             alertify.success(response.status);
            //             window.location.replace('/brand');
            //             // $('.brand_data').html("");
            //             // loadBrand();
            //         }
            //     })
            // }
        })
    });

</script>
    

<?= $this->endSection() ?>