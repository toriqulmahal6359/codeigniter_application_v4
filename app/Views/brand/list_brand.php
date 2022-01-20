<?= $this->extend('layouts/front_end.php') ?>

<?= $this->section('content') ?>

<!-- Add Popup -->
<div class="modal fade" id="addbrandModal" tabindex="-1" aria-labelledby="addbrandModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addbrandModalLabel">Add Brand</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <label for="">Brand Name<span style="color:red">*</span></label>
                <input type="text" id="name" name="name" class="form-control mt-2">
                <span id="error_name" class="text-danger ms-2"></span>
            </div>
            <button type="button" class="btn btn-secondary my-2 add_new_brand" id="brand_add">Add</button>
      </div>
    </div>
  </div>
</div>

<!-- Update Popup -->
<div class="modal fade" id="editbrandModal" tabindex="-1" aria-labelledby="editbrandModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editbrandModalLabel">Edit Brand</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <input type="hidden" id="brand_id" name="brand_id">
            <div class="form-group">
                <label for="">Brand Name<span style="color:red">*</span></label>
                <input type="text" id="brand_name" name="brand_name" class="form-control mt-2">
                <span id="error_name_update" class="text-danger ms-2"></span>
            </div>
            <button type="button" class="btn btn-secondary my-2 update_brand" id="brand_update">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Popup -->
<div class="modal fade" id="deletebrandModal" tabindex="-1" aria-labelledby="deletebrandModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletebrandModalLabel">Delete Brand</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <input type="hidden" id="brand_id_del">
            <h6 class="text-center">Are You sure you want to Delete ?</h6>
            <div class="text-center">
                <button type="button" class="btn btn-success my-2 mx-6 delete_brand" id="brand_delete">OK</button>
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
                        <h4>Brand Data</h4>
                    </div>
                    <div class="card-body">
                        <table class="col-md-12 table-bordered table-striped my-4">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Entry Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="brand_data">
                                <?php foreach($brands as $row): ?>
                                <tr>
                                    <td class="brand_id"><?= $row['id']; ?></td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?=
                                        date("M d, Y", strtotime($row['entry_date'])); ?>
                                    </td>
                                    <td>
                                        <a href="#"><i class="fa fa-pencil-square-o fa-lg text-secondary mx-2 edit-btn" aria-hidden="true"></i></a>
                                        <a href="#" ><i class="fa fa-trash-o fa-lg text-danger mx-2 del-btn" aria-hidden="true"></i></a></td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <a href="" data-bs-toggle="modal" data-bs-target="#addbrandModal" class="btn btn-primary float-end">Add Brand</a>
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
            var brand_id = $(this).closest('tr').find('.brand_id').text();

            $.ajax({
                method: "POST",
                url: "brand/edit_brand",
                data: {
                    'id' : brand_id
                },
                success:function(response){
                    $.each(response, function(key, value){
                        $('#brand_id').val(value['id']);
                        $('#brand_name').val(value['name']);
                        $('#editbrandModal').modal('show');
                    });
                }
            });
        });
        
        $('#brand_update').on('click', function(){

            var char_pattern = /^[a-zA-Z0-9]*$/; 
            var brand_name = $('#brand_name').val();
            var check_brand_name = $.trim($('#brand_name').val());

            if($.trim(brand_name).length == 0){
                error_name = "Brand Name is mandatory !!!";
                $('#error_name_update').text(error_name);
            }else if($('#brand_name').val().length >= 50){
                error_name = "Maximum Length is 50 !!!";
                $('#error_name_update').text(error_name);
            }else if(!char_pattern.test(brand_name)){
                error_name = "Should contain Characters !!!";
                $("#error_name_update").text(error_name)
            }else{
                var data = {
                    'brand_id' : $('#brand_id').val(),
                    'brand_name' : $('#brand_name').val(),
                    'check_brand_name' : check_brand_name
                };
                $.ajax({
                    method: "POST",
                    url: "brand/update_brand",
                    data: data,
                    success:function(response){
                        $('#editbrandModal').modal('hide');
                        console.log(response);
                        //window.location.href = response.redirect;
                        alertify.set('notifier', 'position', 'bottom-left');
                        alertify.success(response.status);
                        window.location.replace('/brand');
                        // $('.brand_data').html("");
                        // loadBrand();
                    }
                });
            }
        });
    });

    $(document).on('click', '.del-btn', function(){
        var brand_id = $(this).closest('tr').find('.brand_id').text();
        $('#brand_id_del').val(brand_id);
        $('#deletebrandModal').modal('show');
        
    });

    $('#brand_delete').on('click', function(){
        var delete_id = $('#brand_id_del').val();
        $.ajax({
            method: "POST",
            url: "brand/delete_brand",
            data: {
                "brand_id_del" : delete_id
            },
            success: function(response){
                $("#deletebrandModal").modal('hide');
                alertify.set('notifier', 'position', 'bottom-left');
                alertify.success(response.status);
                window.location.replace('/brand');
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
        $('.add_new_brand').on('click', function(){
            var char_pattern = /^[a-zA-Z0-9]*$/; 
            var brand_name = $('#name').val();
            var check_brand_name = $.trim($('#name').val());

            if($.trim(brand_name).length == 0){
                error_name = "Brand Name is mandatory !!!";
                $('#error_name').text(error_name);
            }else if($('#name').val().length >= 50){
                error_name = "Maximum Length is 50 !!!";
                $('#error_name').text(error_name);
            }else if(!char_pattern.test(brand_name)){
                error_name = "Should contain Characters !!!";
                $("#error_name").text(error_name);
            }else if(check_brand_name != ''){
                var data = {
                    'name' : $("#name").val(),
                    'check_brand_name' : check_brand_name
                };
                $.ajax({
                    method: "POST",
                    url: "/brand/add_brand",
                    data: data,
                    success:function(response){
                        if(response == "1"){
                            $("#error_name").text("Brand name is Already Exists");
                        }else{
                            $('#addbrandModal').modal('hide');
                            $('#addbrandModal').find('input').val('');
                            alertify.set('notifier', 'position', 'bottom-left');
                            alertify.success(response.status);
                            window.location.replace('/brand');
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