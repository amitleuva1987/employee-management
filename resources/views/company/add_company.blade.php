@extends('layouts.app')
@section('content')
<div class="container">
<h2 class="mb-3">CREATE A COMPANY</h2>    
<form action="{{ route('companies.store') }}" class="row g-3" method="post" >
  @csrf  
  <div class="col-md-6">
    <label for="company_name" class="form-label">Company Name <span style="color:red">*</span></label> 
    <input type="text" name="company_name" class="form-control" id="company_name" value="{{old('company_name')}}">
    @error('company_name')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-md-6">
    <label for="company_type" class="form-label">Company Type <span style="color:red">*</span></label>
    <select name="company_type" id="company_type" class="form-select">
      <option value="" selected>Choose...</option>
      <option value="Public Limited Company">Public Limited Company</option>
      <option value="Private Limited Company">Private Limited Company</option>
      <option value="Registered Company">Registered Company</option>
    </select>
    @error('company_type')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-12">
    <label for="website" class="form-label">Website <span style="color:red">*</span></label>
    <input type="text" name="website" class="form-control" id="website"  value="{{old('website')}}">
    @error('website')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-12">
    <label for="company_description" class="form-label">Company Description <span style="color:red">*</span></label>
    <textarea name="company_description" id="company_description" class="form-control" >{{old('company_description')}}</textarea>
    @error('company_description')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  
  
  <div class="col-12">
    <button type="submit" class="btn btn-primary">CREATE</button>
  </div>
</form>
</div>    
@endsection