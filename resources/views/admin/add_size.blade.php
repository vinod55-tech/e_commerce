@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h1>Add Size</h1>
    </div>
    <div id="message">

    </div>
    <form id="size_form">
        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" class="form-control" id="size" name="size" placeholder="Enter size">
        </div>
        <br>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        $(document).ready(function(){
            $('#size_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:'/api/create-size',
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
