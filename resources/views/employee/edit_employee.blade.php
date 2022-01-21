@extends('layouts.app')
@section('content')
<div class="container">
<h2 class="mb-3">CREATE AN EMPLOYEE</h2>    
<form class="row g-3" method="post" action="{{route('employees.update',$employee->employee_id)}}">
  @csrf  
  @method('PUT')
  <div class="col-md-6">
    <label for="company_name" class="form-label">Company Name <span style="color:red">*</span></label>
    <select name="company_name" id="company_name" class="form-select">
      <option selected value="">Choose...</option>
      @foreach($companies as $company)
      <option @if($company->company_id == $employee->company_id) {{ __('selected')}} @endif value="{{ $company->company_id }}">{{ $company->company_name }}</option>
      @endforeach
    </select>
    @error('company_name')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-md-6">
    <label for="email_address" class="form-label">Email Address <span style="color:red">*</span></label>
    <input type="email" name="email_address" class="form-control" id="email_address" value="{{ $employee->email_address }}">
    @error('email_address')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-md-6">
    <label for="first_name" class="form-label">First Name <span style="color:red">*</span></label>
    <input type="text" name="first_name" class="form-control" id="first_name" value="{{ $employee->first_name }}">
    @error('first_name')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-md-6">
    <label for="last_name" class="form-label">Last Name <span style="color:red">*</span></label>
    <input type="text" name="last_name" class="form-control" id="last_name" value="{{ $employee->last_name }}">
    @error('last_name')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-md-6">
    <label for="position" class="form-label">Position <span style="color:red">*</span></label>
    <input type="text" name="position" class="form-control" id="position" value="{{ $employee->position }}">
    @error('position')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-md-6">
    <label for="city" class="form-label">City <span style="color:red">*</span></label>
    <input type="text" name="city" class="form-control" id="city" value="{{ $employee->city }}">
    @error('city')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-md-6">
    <label for="country" class="form-label">Country <span style="color:red">*</span></label>
    <input type="text" name="country" class="form-control" id="country" value="{{ $employee->country }}">
    @error('country')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-md-6">
    <label for="status" class="form-label">Status <span style="color:red">*</span></label>
    <select id="status" name="status" class="form-select">
      <option @if($employee->status == 'Active') {{ __('selected') }} @endif value="Active">Active</option>
      <option @if($employee->status == 'Inactive') {{ __('selected') }} @endif value="Inactive">Inactive</option>
    </select>
    @error('status')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  
  <div class="col-12">
    <button type="submit" class="btn btn-primary">UPDATE</button>
  </div>
</form>
</div>
@endsection