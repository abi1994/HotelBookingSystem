@extends('frontlayout')
@section('content')
<div class="container my-4">
	<h3 class="mb-3">Room Booking</h3>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <p class="text-danger">{{$error}}</p>
        @endforeach
    @endif

    @if(Session::has('success'))
    <p class="text-success">{{session('success')}}</p>
    @endif
    <div class="table-responsive">
        <form method="post" enctype="multipart/form-data" action="{{url('admin/booking')}}">
            @csrf
            <table class="table table-bordered">
                <tr>
                    <th>CheckIn Date <span class="text-danger">*</span></th>
                    <td><input name="check_in_date" type="date" class="form-control checkin-date" /></td>
                </tr>
                <tr>
                    <th>CheckOut Date <span class="text-danger">*</span></th>
                    <td><input name="check_out_date" type="date" class="form-control" /></td>
                </tr>
                <tr>
                    <th>Avaiable Rooms <span class="text-danger">*</span></th>
                    <td>
                        <select class="form-control room-list" name="room_id">

                        </select>
                        <p>Price: <span class="show-room-price"></span></p>
                    </td>
                </tr>
                <tr>
                    <th>Total Adults <span class="text-danger">*</span></th>
                    <td><input name="total_adults" type="text" class="form-control" /></td>
                </tr>
                <tr>
                    <th>Total Children</th>
                    <td><input name="total_children" type="text" class="form-control" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        @if(Session::has('data'))
                    	<input type="hidden" name="selected_customer_id" value="{{Auth::user()->id}}" />
                        @endif
                        <input type="hidden" name="total_price" class="room-price" value="" />
                    	<input type="hidden" name="ref" value="front" />
                        <input type="submit" class="btn btn-primary" />
                    </td> 
                </tr>
            </table>
        </form>
    </div>               
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".checkin-date").on('blur',function(){
            var _checkindate=$(this).val();
            // Ajax
            $.ajax({
                url:"{{url('admin/booking')}}/available-rooms/"+_checkindate,
                dataType:'json',
                beforeSend:function(){
                    $(".room-list").html('<option>--- Loading ---</option>');
                },
                success:function(res){
                console.log(res, 'res');
                    var _html='';
                    $.each(res.data,function(index,row){
                        console.log(row.room_type.name, 'row')
                        _html+='<option data-price="'+row.room_type.price+'" value="'+row.id+'">'+row.title+' - '+row.room_type.name+'</option>';
                    });
                    $(".room-list").html(_html);

                    var _selectedPrice=$(".room-list").find('option:selected').attr('data-price');
                    $(".room-price").val(_selectedPrice);
                    $(".show-room-price").text(_selectedPrice);
                }
            });
        });
        
        $(document).on("change",".room-list",function(){
            var _selectedPrice=$(this).find('option:selected').attr('data-price');
            $(".room-price").val(_selectedPrice);
            $(".show-room-price").text(_selectedPrice);
        });
    });
</script>

@endsection