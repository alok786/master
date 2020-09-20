
<?php $__env->startSection('style'); ?>
<style>
.error{
    color:red;
}     
</style>   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container" style="max-width: 1360px; !important">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <?php echo e(__('Dashboard')); ?>

                   
                    <div class="btn-group float-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add new</button>
                        <button type="button" class="btn btn-danger bulk_delete" disabled>Bulk delete</button>
                       
                    </div>
                    
                     
                     
                </div>

                <div class="card-body">
                    <table class="table table-responsive-sm table-striped datatable" id="usertable">
                        <thead>
                          <tr>
                                
                                <th><input type="checkbox" class="check_all" ></th>
                                <th>Name</th>
                                <th>Contact Number</th>
                            
                                <th>Hobbies</th>
                                <th>Category</th>
                                <th>Image</th>
                            
                                
                                
                                <th>Action</th>
                            
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



  <!-- The Modal -->
  <div class="modal " id="myModal">
    <div class="modal-dialog" style="max-width: 900px !important">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
       
                      <div class="alert  alert-dismissible" style="display: none" id="message">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong></strong> 
                      </div>
        
        <form id='userform' name="userform">
        <div class="modal-body">
           
                <div class="form-group">
                    <label for="exampleInput">Name</label>
                    <input type="text" class="form-control"  name="name" id="name"  aria-describedby="" placeholder="Name" required>
    
                    </div>
                    <div class="form-group">
                    <label for="exampleInput">Contract Number</label>
                    <input type="number" class="form-control" name="contact_number" id="contact_number" aria-describedby="" placeholder="Contract Name" required>
    
                </div>
                   <div class="form-group">
                      <label for="example">Hobbies</label>
                      <div class="form-check-inline float-right">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" id="chk1" value="Programming">Programming
                        </label>
                      </div>
                      <div class="form-check-inline float-right">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" id="chk2" value="Reading">Reading
                        </label>
                      </div>
                      <div class="form-check-inline float-right">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" id="chk3" value="Games" >Games
                        </label>
                      </div>
                      <div class="form-check-inline float-right">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" id="chk4" value="Photography" >Photography
                        </label>
                      </div>
                   </div>
                   <div class="custom-file">
                    <input type="file" class="custom-file-input" id="change_photo" name="change_photo">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                   
                   
                            <div class="form-group ">
                                <label for="exampleFormControlSelect2">Category</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="">Slelect</option>
                                    <?php if(isset($category)): ?>
                                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item['id']); ?>"><?php echo e($item['name']); ?></option>     
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                    <?php endif; ?>
                                        
                                </select>
                    
                            </div>  
                             
            
            
            
        
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="submit">submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        
        </div>
        </form>
    </div>
  </div>
  

<?php $__env->stopSection(); ?>



<?php $__env->startSection('javascript'); ?>
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
<script type="text/javascript">
   
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var base_url = "<?php echo e(url('/')); ?>";
</script>
<script>
    var usertable;
     $(document).ready(function () {
     


        usertable = $('#usertable').DataTable({

            destroy: true,
            processing: false,
            serverSide: true,
            stateSave: true,
            ajax: "http://127.0.0.1:8000/get/user/data",
            columns: [
                {data:'checkbox', name:'checkbox',orderable:false},
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
                {data: 'hobbies', name: 'hobbies'},
                {data: 'category', name: 'category'},
                {data: 'image', name: 'image'},
                {data: 'action', name: 'action'}
                


            ],
            "lengthMenu": [[5, 25, 50, -1], [5, 10, 25, 'All']],
            columnDefs: [
                // {targets: [0,4,5,6,7], orderable: false},
                // {className: 'center', targets: [0,1,6,7]},
                // { className: "text-ellipsis", "targets": [ 4 ] }

            ],

            // "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {

            //     $(nRow).children().each(function(index, td) {

            //         if (index == 5) {
            //             $(td).css("color", "#39cc5f");
            //         }
            //     });
            //     return nRow;
            // },


        });

        // $('.datatableactive ').on('draw.dt', function () {
        //     $('[data-toggle="tooltip"]').tooltip();
        //     $('#td-name').removeClass('text-ellipsis');
        // });




    });
    </script> 
<script>
    $(document).ready(function() {
        
    //$('#ticket_table').DataTable();

          $.validator.addMethod("valueNotEquals", function(value, element, arg){
          return arg !== value;
          }, "Please select.");
          $("form[name='userform']").validate({
          
            rules: {
              
              name: { valueNotEquals: "default" },
              contact_number: { 
                valueNotEquals: "default",
                required:true,
                minlength:10,
                maxlength:12,
                number: true 
              },
              hobbies: { valueNotEquals: "default" },
              category: { valueNotEquals: "default" },
            
            },
            
            messages: {
              name: { valueNotEquals: "Please select a division from list" },
              contact_number: { valueNotEquals: "Please select a subdivision from list" },
              hobbies: { valueNotEquals: "Please select a service station from list" },
              category: { valueNotEquals: "Please select category" },
            
              
              
            },
          
            submitHandler: function(form) {
              //form.submit();
            }
          });
  var file_data = null;
  $(document.body).on('change', '#change_photo', function () {
     file_data = $('#change_photo').prop('files')[0];
  });

    $(document.body).on('click', '#submit', function () {
        var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
        

                
                
                console.log(file_data);
                var form_data = new FormData();
                form_data.append('name', $('#name').val());
                form_data.append('contact_number', $('#contact_number').val());
                form_data.append('hobbies', val);
                form_data.append('category', $('#category option:selected').val() ?? null);
                if(file_data != null)
                form_data.append('file', file_data, file_data.name);
                // for (var pair of form_data.entries()) {
                //     console.log(pair[0]+ ', ' + pair[1]); 
                // }
                //console.log(form_data);
               
              
                var url = `http://127.0.0.1:8000/users`;
                console.log(url)
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType    : 'json',           // what to expect back from the PHP script, if anything
                    contentType : false,
                    processData : false,
                    data:form_data,
                    beforeSend: function () {
                        console.log("Process Started");
                    },
                    complete: function () {
                        
                    },
                    success: function (response) {
                       
                        if(response.status == 200){
                            toastr["success"](response.message)
                            
                        }else{
                            toastr["error"](response.message)
                        }
                        console.log("Process complete",response);
                       
                        usertable.ajax.reload(null, false);
                    },
                    error:function (error) {
                        console.log(error);
                        toastr["error"](error.message)
                        console.log('Something wrong please try after sometimes!')
                    }

                });

        });        
    });
    $(document.body).on('click', '.edit', function () {
      var id =  $(this).attr('data-id')
      $(this).next().css('display','block')
       
       var textname = $('#editname'+id).text();
       var textphone = $('#editphone'+id).text();
      
       var htmlname = '<input type="text" class="form-control" value="'+textname+'" id="name_edit'+id+'">'
       var htmlphone = '<input type="text" class="form-control" value="'+textphone+'" id="phone_edit'+id+'">'
       var htmlhobbies = `<div class="form-check-inline">
                          <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" id="chk1" value="Programming">Programming
                          </label>
                        </div>
                          <div class="form-check-inline">
                          <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" id="chk1" value="Reading">Reading
                          </label>
                        </div>
                          <div class="form-check-inline ">
                          <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" id="chk1" value="Photography">Photography
                          </label>
                        </div>
                          <div class="form-check-inline">
                          <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" id="chk1" value="Games">Games
                          </label>
                          </div>
                          
                          `
        var htmlcategory = `<select class="form-control" id="category" name="category" required="">
                              <option value="">Slelect</option>
                              <option value="1">Devloper</option>     
                              <option value="2">Designer</option>     
                              <option value="3">Tester</option>     
                            </select>
                            `
        var htmlimage = `
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="change_photo" name="change_photo">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
        `
       $('#editname'+id).parent().empty().append(htmlname)
       $('#editphone'+id).parent().empty().append(htmlphone)
       $('#edithobbies'+id).parent().empty().append(htmlhobbies)
       $('#editcategory'+id).parent().empty().append(htmlcategory)
       $('#image'+id).parent().empty().append(htmlimage)
       //$('#edithobbies'+id).parent().empty().append(html)
      // $('#editcategory'+id).parent().empty().append(html)
       //$('#image'+id).parent().empty().append(html)
       
    });

    $(document.body).on('click', '#save', function () {
      var id = $(this).attr('data-id')
      var name = $('#name_edit'+id).val();
      var phone = $('#phone_edit'+id).val();

      var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
      var hobbies = val;
      var category = $('#category option:selected').val() ?? null;
     
      
      var file = $('#change_photo')[0].files[0]
      

               var form_data = new FormData();
                form_data.append('id', id);
                form_data.append('name', $('#name_edit'+id).val());
                form_data.append('contact_number', $('#phone_edit'+id).val());
                form_data.append('hobbies', hobbies);
                form_data.append('category', category);
                if(file)
                form_data.append('file', file, file.name);
               
               
              
                var url = `http://127.0.0.1:8000/users/edit`;
                console.log(url)
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType    : 'json',           // what to expect back from the PHP script, if anything
                    contentType : false,
                    processData : false,
                    data:form_data,
                    beforeSend: function () {
                        console.log("Process Started");
                    },
                    complete: function () {
                        
                    },
                    success: function (response) {
                       
                        if(response.status == 200){
                            toastr["success"](response.message)
                            
                        }else{
                            toastr["error"](response.message)
                        }
                        console.log("Process complete",response);
                       
                        usertable.ajax.reload(null, false);
                    },
                    error:function (error) {
                        console.log(error);
                        toastr["error"](error.message)
                        console.log('Something wrong please try after sometimes!')
                    }

                });

      

    });

   

    $(".check_all").change(function() {
      
        if (this.checked) {
            $(".deleterow").each(function() {
                this.checked=true;
            });
            $('.bulk_delete').prop('disabled', false);
        } else {
            $(".deleterow").each(function() {
                this.checked=false;
            });
            $('.bulk_delete').prop('disabled', true);
        }
    });

    $('.bulk_delete').click(function(){
        var arr = [];
        $('.deleterow').each(function(){
          arr.push($(this).attr('data-id'))
        })
       
        deleteRow(arr);
    });
    $(document.body).on('click', '.delete', function () {
       deleteRow($(this).attr('data-id'));
    });

    function deleteRow(arr){
      Swal.fire({
            title: 'Are you sure you want to delete all selected row?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              var url = `http://127.0.0.1:8000/users/delete`;
              $.ajax({
                    url: url,
                    type: 'post',
                    dataType    : 'json',           // what to expect back from the PHP script, if anything
                  
                    data:{row_id:arr},
                    beforeSend: function () {
                        console.log("Process Started");
                    },
                    complete: function () {
                        
                    },
                    success: function (response) {
                       
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                       
                        usertable.ajax.reload(null, false);
                    },
                    error:function (error) {
                        console.log(error);
                        toastr["error"](error.message)
                        console.log('Something wrong please try after sometimes!')
                    }

                });

             
            }
          })
    }

  

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\myprog\task\WamaTask\resources\views/users.blade.php ENDPATH**/ ?>