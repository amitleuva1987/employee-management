@extends('layouts.app')
@section('content')
<div class="container">
<h2 class="mb-3">CREATE AN EMPLOYEE</h2>    
<form class="row g-3" method="post" action="{{route('employees.store')}}" enctype="multipart/form-data">
  @csrf  
  <div class="col-md-6">
    <label for="company_name" class="form-label">Company Name <span style="color:red">*</span></label>
    <select name="company_id" id="company_id" class="form-select">
      <option selected value="">Choose...</option>
      @foreach($companies as $company)
      <option @if(session()->has('company_id') &&  session()->get('company_id') == $company->company_id) {{ __('selected') }}@endif value="{{ $company->company_id }}">{{ $company->company_name }}</option>
      @endforeach
    </select>
    @error('company_id')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-md-6">
    <label for="email_address" class="form-label">Email Address <span style="color:red">*</span></label>
    <input type="email" name="email_address" class="form-control" id="email_address" value="{{old('email_address')}}">
    @error('email_address')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-md-6">
    <label for="first_name" class="form-label">First Name <span style="color:red">*</span></label>
    <input type="text" name="first_name" class="form-control" id="first_name" value="{{old('first_name')}}">
    @error('first_name')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-md-6">
    <label for="last_name" class="form-label">Last Name <span style="color:red">*</span></label>
    <input type="text" name="last_name" class="form-control" id="last_name" value="{{old('last_name')}}">
    @error('last_name')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-md-6">
    <label for="position" class="form-label">Position <span style="color:red">*</span></label>
    <input type="text" name="position" class="form-control" id="position" value="{{old('position')}}">
    @error('position')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-md-6">
    <label for="city" class="form-label">City <span style="color:red">*</span></label>
    <input type="text" name="city" class="form-control" id="city" value="{{old('city')}}">
    @error('city')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-md-6">
    <label for="country" class="form-label">Country <span style="color:red">*</span></label>
    <input type="text" name="country" class="form-control" id="country" value="{{old('country')}}">
    @error('country')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-md-6">
    <label for="country" class="form-label">Image <span style="color:red">*</span></label>
    <input type="file" name="image" class="form-control" id="image">
    @error('image')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-md-6">
    <label for="status" class="form-label">Status <span style="color:red">*</span></label>
    <select id="status" name="status" class="form-select">
      <option value="Active">Active</option>
      <option value="Inactive">Inactive</option>
    </select>
    @error('status')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  
  <div class="col-12">
    <button type="submit" class="btn btn-primary">CREATE</button>
  </div>
</form>
</div>
@endsection