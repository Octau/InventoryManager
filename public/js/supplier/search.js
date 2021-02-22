$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    fetch_data();
    function fetch_data(name=''){
        $.ajax({
            url:"{{ route('livesearch') }}",
            method: 'GET',
            data:{name:name},
            dataType:'json',
            success:function(data){
                $('#table_content').html(data.table_data);
                $('#total_record').text(data.total_data);
            }
        });
    }
    $(document).on('keyup', '#input_search', function(){
        var name = $(this).val();
        fetch_data(name);
    });
});

