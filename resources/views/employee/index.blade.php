@extends('layouts.app')
@section('css_section')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
        <h2>EMPLOYEES</h2>
        </div>
        <div class="col-md-6 ">
        
        </div>    
    </div>
    @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
    @endif
    <div class="row">
    
    <div class="col-md-10"> <a class="btn btn-primary" href="{{route('employees.create')}}">ADD NEW</button></a>  </div>  
    <div class="col-md-2 mb-3">
    <select class="form-select" id="company_name">
        <option value="">Select Company</option>
        @foreach($companies as $company)
        <option value="{{ $company->company_id }}">{{ $company->company_name }}</option>
        @endforeach
        
    </select>    
    </div>
    
    </div>
    <table class="table table-bordered display dataTable" id="employee_table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Position</th>
                <th>City</th>
                <th>Country</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->employee_id }}</td>
                <td>{{ $employee->first_name." ".$employee->last_name }}</td>
                <td>{{ $employee->company->company_name }}</td>
                <td>{{ $employee->email_address }}</td>
                <td>{{ $employee->position }}</td>
                <td>{{ $employee->city }}</td>
                <td>{{ $employee->country }}</td>
                <td>
                <form action="{{ route('employees.destroy',$employee->employee_id) }}" method="POST">
                    @csrf
                    @method('DELETE')    
                <a class="btn btn-warning btn-sm" href="{{route('employees.edit',$employee->employee_id)}}">EDIT</a> <button class="btn btn-danger btn-sm" onclick="return ConfirmDelete();">DELETE</button>
                </form>
                </td>
            </tr>
            @endforeach
            </tbody>
    </table>    
</div>
@endsection

@section('script_section')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" ></script>
    
    <script>
         function ConfirmDelete()
        {
            return confirm("Are you sure you want to delete?");
        }
         $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });   
            table = $('#employee_table').DataTable();

            $('#company_name').change(function(){
                
                if(this.value == ""){
                    return false;
                }

                $.ajax({
                    url: "{{route('set_session')}}",
                    method:"post",
                    data: { company_id: this.value }
                });    

                var company_name = $(this).find('option:selected').text();
                $.fn.dataTable.ext.search.push(
                    function( settings, data, dataIndex ) {
                        return data[2]==company_name
                            ? true
                            : false
                    }     
                );
                table.draw();
                $.fn.dataTable.ext.search.pop();
            });
         
        });
    
</script>        
@endsection