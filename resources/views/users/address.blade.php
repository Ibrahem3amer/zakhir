  @extends('layouts.base')

@section('body')
	<div class="container">
		<div class="row">
		    <div class="col-md-4 col-md-offset-4">
		      <form url="/users/address" method="post" class="form-horizontal" role="form">
      		    <input type="hidden" name="_token" value="{{ csrf_token() }}">
		        <fieldset>
    				
				@if (count($errors) > 0)
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif

		          <!-- Form Name -->
		          <legend>Address Details</legend>

		          <!-- Text input-->
		          <div class="form-group">
		            <label class="col-sm-2 control-label" for="textinput">Line 1</label>
		            <div class="col-sm-10">
		              <input type="text" name="address_1" placeholder="Address Line 1" class="form-control">
		            </div>
		          </div>

		          <!-- Text input-->
		          <div class="form-group">
		            <label class="col-sm-2 control-label" for="textinput">Line 2</label>
		            <div class="col-sm-10">
		              <input type="text" name="address_2" placeholder="Address Line 2" class="form-control">
		            </div>
		          </div>

		          <!-- Text input-->
		          <div class="form-group">
		            <label class="col-sm-2 control-label" for="textinput">City</label>
		            <div class="col-sm-10">
		              <input type="text" name="address_city" placeholder="City" class="form-control">
		            </div>
		          </div>

		          <!-- Text input-->
		          <div class="form-group">
		            <label class="col-sm-2 control-label" for="textinput">State</label>
		            <div class="col-sm-4">
		              <input type="text" name="address_state" placeholder="State" class="form-control">
		            </div>

		            <label class="col-sm-2 control-label" for="textinput">Postcode</label>
		            <div class="col-sm-4">
		              <input type="text" name="address_post" placeholder="Post Code" class="form-control">
		            </div>
		          </div>



		          <!-- Text input-->
		          <div class="form-group">
		            <label class="col-sm-2 control-label" for="textinput">Country</label>
		            <div class="col-sm-10">
		              <input type="text" name="address_country" placeholder="Country" class="form-control">
		            </div>
		          </div>

		          <div class="form-group">
		            <div class="col-sm-offset-2 col-sm-10">
		              <div class="pull-right">
		                <button type="submit" class="btn btn-default">Cancel</button>
		                <button type="submit" class="btn btn-primary">Save</button>
		              </div>
		            </div>
		          </div>

		        </fieldset>
		      </form>
		    </div><!-- /.col-lg-12 -->
		</div><!-- /.row -->
	</div>
@endsection