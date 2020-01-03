@extends('admin.admin_layouts')

@section('admin_content')


<div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Coupon Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Category List
            <a href="#" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal" data-target="#modaldemo3">Add New</a>
          </h6>
          <br>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">ID</th>
                  <th class="wd-15p">Copuon Code</th>
                  <th class="wd-20p">Discount (%) </th>
                  <th class="wd-20p">Action</th>
                  
                </tr>
              </thead>
              <tbody>
              @foreach($coupons as $key=>$coupon)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$coupon->coupon}}</td>
                  <td>{{$coupon->discount}}</td>
                  <td>
                    <a href="{{route('edit.coupon',$coupon->id)}}" class="btn btn-sm btn-info">Edit</a>
                    <a href="{{route('delete.coupon',$coupon->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                  </td>
                  
                 
                </tr>
              @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
      </div><!-- sl-pagebody -->


<div id="modaldemo3" class="modal fade">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
              <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Coupon Add</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
            <form method="post" action="{{route('store.coupon')}}">
              @csrf
              <div class="modal-body pd-20">
                <div class="form-group">
                  <label for="coupon_code">Coupon Code</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Coupon Code" name="coupon_code">
                </div>

                 <div class="form-group">
                  <label for="discount">Discount (%)</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Discount " name="discount">
                </div>
              </div><!-- modal-body -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
              </div>
            </form>
            </div>
          </div><!-- modal-dialog -->
        </div><!-- modal -->

@endsection