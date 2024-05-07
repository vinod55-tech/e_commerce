@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h1>Edit Color</h1>
    </div>
    <div id="message">

    </div>
    <form id="update_color_form">
        <div class="form-group">
            <label for="color">Color</label>
            <input type="hidden" id="color_id" name="id" value="{{$color->id}}">
            <input type="text" class="form-control" id="color" name="color" value="{{$color->color}}" placeholder="Enter color name">
        </div>
        <br>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        $(document).ready(function(){
            $('#update_color_form').on('submit', function(event){
                event.preventDefault();
                var color_id = $('#color_id').val();
                $.ajax({
                    url:'/api/update-color/'+color_id+'',
                    type:'POST',
                    data:$(this).serialize(),
                    success: function(response){
                        if(response.status === "success"){
                            localStorage.setItem('message','<div class="alert alert-success">' + response.message + '</div>');
                            window.location.href ='/color';
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
