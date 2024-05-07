@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h1>Size Page</h1>
        <a href="{{route('add_size')}}" class="btn btn-primary btn-lg float-right" type="submit">Add</a>
    </div>
    <div id="message">

    </div>
    <div class="table-detail">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Color</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="all_sizes">
                <!-- appended datas are here-->
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function(){
            $('#message').html(localStorage.getItem('message'));
                $.ajax({
                    url:'/api/size-list',
                    type:'GET',
                    success: function(response){
                        $('#all_sizes').append(response.data);
                    }
                });

                $('#message').click(function(){
                    localStorage.removeItem('message');
                    $('#message').empty();
                });
        });

        function deleteSize(id){
            $.ajax({
                url:'/api/delete-size/'+id+'',
                type:'GET',
                success: function(response){
                    if(response.status === "success"){
                        $('#all_sizes').load();
                        $('#message').html('<div class="alert alert-success">' + response.message + '</div>');
                    }else{
                        $('#message').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                }

            });
        }
    </script>
</section>
@endsection
