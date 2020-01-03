@extends('admin.admin_layouts')

@section('admin_content')


<div class="sl-mainpanel">
      <div class="sl-pagebody">
        

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Category Update
            <a href="{{route('categories')}}" class="btn btn-sm btn-warning" style="float: right;">Back</a>
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
            <form method="post" action="{{route('update.category',$category->id)}}">
              @csrf
              <div class="modal-body pd-20">
                <div class="form-group">
                  <label for="category_name">Category Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category" name="category_name" value="{{$category->category_name}}">
                </div>
              </div><!-- modal-body -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-info pd-x-20">Update</button>
               
              </div>
            </form>
            <!-- modal-dialog -->
       
      </div><!-- sl-pagebody -->




@endsection