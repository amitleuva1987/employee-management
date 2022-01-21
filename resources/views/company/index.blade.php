@extends('layouts.app')
@section('css_section')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
        <h2>COMPANIES</h2>
        </div>
        <div class="col-md-6 ">
        <a class="btn btn-primary float-end" href="{{ route('companies.create') }}">ADD NEW</a>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif    
    </div>
    <table class="table table-bordered" id="company_table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Company Name</th>
                <th>Company Type</th>
                <th>Website</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $company)
            <tr>
                <td>{{ $company->company_id }}</td>
                <td>{{ $company->company_name }}</td>
                <td>{{ $company->company_type }}</td>
                <td>{{ $company->website }}</td>
                <td> 
                <form action="{{ route('companies.destroy',$company->company_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-warning btn-sm" href="{{route('companies.edit',$company->company_id)}}">EDIT</a>   
                <button class="btn btn-danger btn-sm" onclick="return ConfirmDelete();">DELETE</button>
                </form>
                </td>
            </tr>
            @endforeach
            </tbody>
    </table>    
</div>
@endsection

@section('script_section')
<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" ></script>
    <script scr="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        
        $(document).ready(function() {
            $('#company_table').DataTable();
            
        } );
            function ConfirmDelete()
            {
            return confirm("Are you sure you want to delete?");
            }
    
</script>        
@endsection