<script>

    function hideAllErrors(){
        $('#err-role').hide();
        $('#err-name').hide();
        
    }

    hideAllErrors();

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

     



        //add Role 
        function addRole(){
            $.ajax({
                type: "get",
                url: "{{ url('/managerole') }}",
                success:function(data){
                    $('#employee_wokplace').html(data);
                }
            });
        }

        //view create 
        function dataRefresh(){
            $.ajax({
                type: "get",
                url: "{{ url('/employee') }}",
                success:function(data){
                    $('#employee_wokplace').html(data);
                }
            });
        }

        //view create 
        function create(){
            $.ajax({
                type: "get",
                url: "{{ url('/employee/create') }}",
                success:function(data){
                    $('#employee_wokplace').html(data);
                }
            });
        }

        //add 
      
        
        $(document).on('click', '#btn_add', function(e){
            e.preventDefault();
            hideAllErrors();

            $.ajax({
                url: "{{ url('/employee') }}",
                type: "POST",
                data: {

                    _token: '{{csrf_token()}}',
                    role : $('#role').val(),
                    name : $('#name').val(),
                    phone : $('#phone').val(),
                    email : $('#email').val(),
                    image : $('#image').val(),
                },
                
                success: function(response){            

                var result = $.parseJSON(response);
                alert(response);
                $('#employee_workplace').html(result.form);
                },
                error: function(err){
                    var msg = err.responseJSON.message;
                    var errors = err.responseJSON.errors;
                    $.each(errors, function(key, value){
                        $('#err-'+key).html('<strong>'+value+'</strong>');
                        $('#err-'+key).show();
                    });
                }
            });
        });



        /*
        |--------------------------------------------------------------------------
        | C-R-U-D
        |--------------------------------------------------------------------------
        */
        $(document).on('click', '#btn_view', function(e){
            e.preventDefault();
            dataRefresh();
        });

        $(document).on('click', '#btn_create', function(e){
            e.preventDefault();
            create();
        });
        
        $(document).on('click', '#btn_addrole', function(e){
            e.preventDefault();
            addRole();
        });
        
        
        dataRefresh();

    });

</script>
