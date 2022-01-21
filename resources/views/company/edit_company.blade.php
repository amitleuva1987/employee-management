@extends('layouts.app')
@section('content')
<div class="container">
<h2 class="mb-3">CREATE A COMPANY</h2>    
<form action="{{ route('companies.update', $company->company_id) }}" class="row g-3" method="post" >
  @csrf  
  @method('PUT')
  <div class="col-md-6">
    <label for="company_name" class="form-label">Company Name</label>
    <input type="text" name="company_name" class="form-control" id="company_name" value="{{ $company->company_name }}">
    @error('company_name')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-md-6">
    <label for="company_type" class="form-label">Company Type</label>
    <select name="company_type" id="company_type" class="form-select">
      <option @if($company->company_type == 'Public Limited Company') {{ __('selected') }} @endif value="Public Limited Company">Public Limited Company</option>
      <option @if($company->company_type == 'Private Limited Company') {{ __('selected') }} @endif value="Private Limited Company">Private Limited Company</option>
      <option @if($company->company_type == 'Registered Company') {{ __('selected') }} @endif value="Registered Company">Registered Company</option>
    </select>
    @error('company_type')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-12">
    <label for="website" class="form-label">Website</label>
    <input type="text" name="website" class="form-control" id="website"  value="{{ $company->website }}">
    @error('website')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  <div class="col-12">
    <label for="company_description" class="form-label">Company Description</label>
    <textarea name="company_description" id="company_description" class="form-control" >{{ $company->company_description }}</textarea>
    @error('company_description')
    <p style="color:red">{{ $message }}</p>
    @enderror
  </div>
  
  
  <div class="col-12">
    <button type="submit" class="btn btn-primary">UPDATE</button>
  </div>
</form>
</div>    
@endsection