<?= $this->extend('layouts/front_end.php') ?>

<?= $this->section('content') ?>

<!-- Add Popup -->
<div class="modal fade" id="addmodelModal" tabindex="-1" aria-labelledby="addmodelModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addmodelModalLabel">Add Brand</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <label for="">Brand<span style="color:red">*</span></label>
                <select name="brand_id" id="brand_id" class="form-control mt-2">
                    <option value="0">--Select Brand--</option>
                    <?php foreach($brands as $key=>$row){ ?>
                        <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                    <?php } ?>
                </select>
                <span id="error_brand" class="text-danger ms-2"></span>
            </div>
            <div class="form-group">
                <label for="">Model Name<span style="color:red">*</span></label>
                <input type="text" id="model_name" name="model_name" class="form-control mt-2">
                <span id="error_model_name" class="text-danger ms-2"></span>
            </div>
            <button type="button" class="btn btn-secondary my-2 add_new_model" id="model_add">Add</button>
      </div>
    </div>
  </div>
</div>

<!-- Update Popup -->
<div class="modal fade" id="editmodelModal" tabindex="-1" aria-labelledby="editmodelModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editmodelModalLabel">Edit Model</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <input type="hidden" id="model_id" name="model_id">
            <div class="form-group">
                <label for="">Brand<span style="color:red">*</span></label>
                <select name="brand_id_update" id="brand_id_update" class="form-control mt-2">
                    <option value="0">--Select Brand--</option>
                    <?php foreach($brands as $key=>$row){ ?>
                        <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                    <?php } ?>
                </select>
                <span id="error_brand_update" class="text-danger ms-2"></span>
            </div>
            <div class="form-group">
                <label for="">Model Name<span style="color:red">*</span></label>
                <input type="text" id="model_name_update" name="model_name_update" class="form-control mt-2">
                <span id="error_model_name_update" class="text-danger ms-2"></span>
            </div>
            <button type="button" class="btn btn-secondary my-2 update_model" id="model_update">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Popup -->
<div class="modal fade" id="deletemodelModal" tabindex="-1" aria-labelledby="deletemodelModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletemodelModalLabel">Delete Model</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <input type="hidden" id="model_id_del">
            <h6 class="text-center">Are You sure you want to Delete ?</h6>
            <div class="text-center">
                <button type="button" class="btn btn-success my-2 mx-6 delete_model" id="model_delete">OK</button>
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
                        <h4>Model Data</h4>
                    </div>
                    <div class="card-body">
                        <table class="col-md-12 table-bordered table-striped my-4">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Brand Name</th>
                                    <th>Entry Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="brand_data">
                                <?php foreach($model as $key=>$list): ?>

                                <tr>
                                    <td class="model_id"><?= $list['model_id'] ?></td>
                                    <td><?= $list['model_name']; ?></td>
                                    <td><?= $list['brand_name']; ?></td>
                                    <td><?=
                                        date("d/m/Y", strtotime($list['entry_date'])); ?>
                                    </td>
                                    <td>
                                        <a href="#"><i class="fa fa-pencil-square-o fa-lg text-secondary mx-2 edit-btn" aria-hidden="true"></i></a>
                                        <a href="#" ><i class="fa fa-trash-o fa-lg text-danger mx-2 del-btn" aria-hidden="true"></i></a>
                                    </td>
                                    <?php endforeach ?>
                                </tr>
                                
                            </tbody>
                        </table>
                        <a href="" data-bs-toggle="modal" data-bs-target="#addmodelModal" class="btn btn-primary float-end">Add Model</a>
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
            var model_id = $(this).closest('tr').find('.model_id').text();
            // alert(model_id);
            $.ajax({
                method: "POST",
                url: "model/edit_model",
                data: {
                    'id' : model_id,
                },
                success:function(response){
                    $.each(response, function(key, value){
                        console.log(response);
                        $('#model_id').val(value['id']);
                        $('#brand_id_update').val(value['brand_id']);
                        $('#model_name_update').val(value['model_name']);
                        $('#editmodelModal').modal('show');
                    });
                }
            });
        });
        
        $('#model_update').on('click', function(){

            var char_pattern = /^[a-zA-Z0-9]*$/; 
            var brand_id = $('#brand_id_update').val();
            var model_name = $('#model_name_update').val();

            if($.trim(model_name).length == 0 || brand_id == ''){
                if($.trim(model_name).length == 0){
                    error_name = "Model Name is mandatory !!!";
                    $('#error_model_name_update').text(error_name);
                }else{
                    error_name = "Brand Name is mandatory !!!";
                    $('#error_brand_update').text(error_name);
                }
            }else if($('#model_name_update').val().length >= 100){
                error_name = "Maximum Length is 100 !!!";
                $('#error_model_name_update').text(error_name);
            }else if(char_pattern.test(model_name)){
                error_name = "Should contain Characters !!!";
                $("#error_brand_update").text(error_name);
            }else{
                var data = {
                    'model_id': $('#model_id').val(),
                    'brand_id_update' : $('#brand_id_update').val(),
                    'model_name_update' : $('#model_name_update').val(),
                };
                $.ajax({
                    method: "POST",
                    url: "model/update_model",
                    data: data,
                    success:function(response){
                        $.each(response, function(key, value){
                            console.log(response);
                            $('#editmodelModal').modal('hide');
                            $('#editmodelModal').find('input').val('');
                            //window.location.href = response.redirect;
                            alertify.set('notifier', 'position', 'bottom-left');
                            alertify.success(response.status);
                            window.location.replace('/model');
                            // $('.brand_data').html("");
                            // loadBrand();
                        })
                    }
                });
            }
        });
    });

    $(document).on('click', '.del-btn', function(){
        var model_id = $(this).closest('tr').find('.model_id').text();
        $('#model_id_del').val(model_id);
        $('#deletemodelModal').modal('show');
        
    });

    $('#model_delete').on('click', function(){
        var delete_id = $('#model_id_del').val();
        alert(delete_id);
        $.ajax({
            method: "POST",
            url: "model/delete_model",
            data: {
                "model_id_del" : delete_id
            },
            success: function(response){
                console.log(response.data);
                $("#deletemodelModal").modal('hide');
                alertify.set('notifier', 'position', 'bottom-left');
                alertify.success(response.status);
                window.location.replace('/model');
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
        $('.add_new_model').on('click', function(){
            var char_pattern = /^[a-zA-Z0-9]*$/; 
            var model_name = $('#model_name').val();
            var brand_name = $('#brand_id').val();
            var check_model_name = $.trim(model_name);

            if($.trim(model_name).length == 0 || brand_name == ''){
                if($.trim(model_name).length == 0){
                    error_name = "Model Name is mandatory !!!";
                    $('#error_model_name').text(error_name);
                }else{
                    error_name = "Brand Name is mandatory !!!";
                    $('#error_brand').text(error_name);
                }
            }else if($('#model_name').val().length >= 100){
                error_name = "Maximum Length is 100 !!!";
                $('#error_model_name').text(error_name);
            }else if(char_pattern.test(model_name)){
                error_name = "Should contain Characters !!!";
                $("#error_model_name").text(error_name);
            }else if(check_model_name != '' && brand_name != ''){
                var data = {
                    'brand_id' : $("#brand_id").val(),
                    'model_name' : $("#model_name").val(),
                    'check_model_name': check_model_name
                };
                $.ajax({
                    method: "POST",
                    url: "/model/add_model",
                    data: data,
                    success:function(response){
                        if(response == "1"){
                            $('error_model_name').text("Model is Already Exists");
                        }else{
                            $('#addmodelModal').modal('hide');
                            $('#addmodelModal').find('input').val('');
                            alertify.set('notifier', 'position', 'bottom-left');
                            alertify.success(response.status);
                            window.location.replace('/model');
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