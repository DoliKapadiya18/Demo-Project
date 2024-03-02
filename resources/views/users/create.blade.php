@extends('users.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New user</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
        <br>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form class="row g-3" action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="col-md-4">
        <label for="inputName" class="form-label fw-bold">Name</label>
        <input type="text" class="form-control" id="inputName" name="name" pattern="[a-zA-Z]+" minlength="3" maxlength="10" placeholder="Enter Name" title="Please enter character only">
    </div>
    <div class="col-md-4">
        <label for="inputEmail4" class="form-label fw-bold">Email</label>
        <input type="email" class="form-control" id="inputEmail4" name="email" pattern="/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/" placeholder="Enter Email Address">
    </div>
    <div class="col-md-4">
        <label for="inputEmail4" class="form-label fw-bold">Mobile Number</label>
        <input type="mobile_number" class="form-control" id="inputEmail4" name="mobile_number" pattern="[6789][0-9]{9}" maxlength="10" placeholder="Enter Mobile Number" title="Please enter valid phone number">
    </div>
    <div class="col-md-12">
        <label for="inputPassword4" class="form-label fw-bold">Gender</label>
        <div class="col-md-12">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="male" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Male
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="female" id="flexRadioDefault2" checked>
                <label class="form-check-label" for="flexRadioDefault2">
                    Female
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <label for="inputCity" class="form-label fw-bold">State</label>
        <input type="text" class="form-control" id="state" name="state" pattern="[a-zA-Z]+" placeholder="Enter State" title="Please enter character only">
        <div id="state_list">
        </div>
    </div>
    <div class="col-md-4">
        <label for="inputCity" class="form-label fw-bold">City</label>
        <input type="text" class="form-control" id="city" name="city" pattern="[a-zA-Z]+" placeholder="Enter City" title="Please enter character only">
    </div>
    <div class="col-md-6">
        <label for="inputAddress" class="form-label fw-bold">Address</label>
        <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Enter 1234 Main St" maxlength="40" title="Max Length is 40">
    </div>
    <div class="col-md-6">
        <label for="inputAddress2" class="form-label fw-bold">Address 2</label>
        <input type="text" class="form-control" id="inputAddress2" name="address2" placeholder="Enter Apartment, studio, or floor" maxlength="40">
    </div>
    <div class="col-md-4">
        <label for="inputPassword" class="form-label fw-bold">Password</label>
        <input type="text" class="form-control" id="inputPassword" name="password" placeholder="Enter Password">
    </div>
    <div class="col-md-4">
        <label for="inputConfirmPassword" class="form-label fw-bold">Confirm Password</label>
        <input type="text" class="form-control" id="inputConfirmPassword" name="password_confirmation" placeholder="Enter Confirm Password">
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Add</button>
    </div>
</form>
  
@endsection

@push('script')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script type="text/javascript">
        var route = "{{ route('search_state') }}";
        $('#state').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    state_name: query
                }, function (data) {
                    return process(data);
                });
            }
        });
    </script>

    <script type="text/javascript">
        var route = "{{ route('search_city') }}";
        $('#city').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    city_name: query
                }, function (data) {
                    return process(data);
                });
            }
        });
    </script>
@endpush