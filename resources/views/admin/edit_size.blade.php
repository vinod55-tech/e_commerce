@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h1>Edit Size</h1>
    </div>
    <div id="message">

    </div>
    <form id="update_size_form">
        <div class="form-group">
            <label for="size">Size</label>
            <input type="hidden" id="size_id" name="id" value="{{$size->id}}">
            <input type="text" class="form-control" id="size" name="size" value="{{$size->size}}">
        </div>
        <br>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        $(document).ready(function(){
            $('#update_size_form').on('submit', function(event){
                event.preventDefault();
                var size_id = $('#size_id').val();
                $.ajax({
                    url:'/api/update-size/'+size_id+'',
                    type:'POST',
                    data:$(this).serialize(),
                    success: function(response){
                        if(response.status === "success"){
                            localStorage.setItem('message','<div class="alert alert-success">' + response.message + '</div>');
                            window.location.href ='/size';
                        }else{
                            $('#message').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    }

                });
            });
        });
    </script>
</section>
@endsection
