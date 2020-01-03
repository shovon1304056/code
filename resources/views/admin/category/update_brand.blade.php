@extends('admin.admin_layouts')

@section('admin_content')


<div class="sl-mainpanel">
      <div class="sl-pagebody">
        

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Brands Update
            <a href="{{route('brands')}}" class="btn btn-sm btn-warning" style="float: right;">Back</a>
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
            <form method="post" action="{{route('update.brand',$brand->id)}}" enctype="multipart/form-data">
              @csrf
              <div class="modal-body pd-20">
                <div class="form-group">
                  <label for="brand_name">Brand Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Brand Name" name="brand_name" value="{{$brand->brand_name}}">
                </div>

                <div class="form-group">
                  <label for="brand_logo">Brand Logo</label>
                  <input type="file" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="Brand Logo" name="brand_logo" >
                </div>

                 <div class="form-group">
                  <label for="old_logo">Old Logo</label>
                  <img src="{{asset('public/media/brands/'.$brand->brand_logo)}}" height="80px;" width="80px;" >
                  <input type="hidden" name="old_logo" value="{{$brand->brand_logo}}">
                </div>

              </div><!-- modal-body -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-info pd-x-20">Update</button>
               
              </div>
            </form>
            <!-- modal-dialog -->
       
      </div><!-- sl-pagebody -->




@endsection