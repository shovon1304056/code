@extends('admin.admin_layouts')

@section('admin_content')


<div class="sl-mainpanel">
      <div class="sl-pagebody">
        

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Coupon Update
            <a href="{{route('coupons')}}" class="btn btn-sm btn-warning" style="float: right;">Back</a>
          </h6>
          <br>
           
              
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
            <form method="post" action="{{route('update.coupon',$coupon->id)}}">
              @csrf
              <div class="modal-body pd-20">
                <div class="form-group">
                  <label for="coupon_code">Coupon Code</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Coupon Code" name="coupon_code" value="{{$coupon->coupon}}">
                </div>

                <div class="form-group">
                  <label for="discount">Discount (%)</label>
                  <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Discount" name="discount" value="{{$coupon->discount}}">
                </div>
              </div><!-- modal-body -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-info pd-x-20">Update</button>
               
              </div>
            </form>
            <!-- modal-dialog -->
       
      </div><!-- sl-pagebody -->




@endsection