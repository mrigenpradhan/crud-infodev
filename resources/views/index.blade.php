@extends('layouts.master')

@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

@if(session()->has('errs'))
<div class="alert alert-danger">
    {{ session()->get('errs') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div>
    <h2>CRUD operations task for InfoDevelopers</h2>
    
    <button type="button" data-toggle="modal" data-target="#formModal">Add New Data</button>
        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($entries as $entry)
                <tr>
                    <td>{{$entry->id}}</td>
                    <td>{{$entry->name}}</td>
                    <td>{{$entry->email}}</td>
                    <td>{{$entry->phone}}</td>
                    <td>{{$entry->gender}}</td>
                    <td>{{$entry->age}}</td>
                    <td><span><a class="btn btn-info" data-toggle="modal" data-target="#editModal{{$entry->id}}">Edit</a></span><span><a onclick="return confirm('Do you really want to delete?');" class="btn btn-danger" href="{{ url('/delete/'.$entry->id) }}"
                                value="{{$entry->id}}">Delete</a></span><span><a class="btn btn-success" data-toggle="modal" data-target="#detailModal{{$entry->id}}">Detail</a></span></td>
                </tr>    
                @endforeach
            </tbody>
        </table>
</div>
            <!-- add data popup modal -->
            <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
                <div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Enter new data</h4>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                    

						<!-- Modal body -->
						<div class="modal-body">
									
                            <!--Start of Form-->
                            <form action="{{url('/new-data')}}" method="POST">
                            {{ csrf_field() }}
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="phone">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" required="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="gender">Gender</label>
                                            <select class="form-control" id="gender" name="gender" required>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                    </div>
                                
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail">Age</label>
                                            <input type="integer" class="form-control" id="age" name="age" placeholder="Enter your age" required="">
                                    </div>
                                </div>    
                                <button type="submit" class="btn btn-success btn-submit">Submit</button>
                            </form>
						</div>
					</div>
                </div>
            </div>

    <!-- edit data popup modal -->
        @foreach($entries as $entry)
            <div class="modal fade" id="editModal{{$entry->id}}" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
                <div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Edit data</h4>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                    

						<!-- Modal body -->
						<div class="modal-body">
									
                            <!--Start of Form-->
                            <form action="{{ url('/edit/'.$entry->id) }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{$entry->name}}" required="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="phone">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{$entry->phone}}" required="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{$entry->email}}" required="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="gender">Gender</label>
                                            <select class="form-control" id="gender" name="gender" required>
                                                <option @if($entry->gender=='Male') {{ 'selected' }} @endif>Male</option>
                                                <option @if($entry->gender=='Female') {{ 'selected' }} @endif>Female</option>
                                            </select>
                                    </div>
                                
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail">Age</label>
                                            <input type="integer" class="form-control" id="age" name="age" value="{{$entry->age}}" required="">
                                    </div>
                                </div>    
                                <button type="submit" class="btn btn-success">Update</button>
                            </form>
						</div>
					</div>
                </div>
            </div>
            @endforeach

<!-- detail data popup modal -->
            @foreach($entries as $entry)
            <div class="modal fade" id="detailModal{{$entry->id}}" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
                <div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Edit data</h4>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                    

						<!-- Modal body -->
						<div class="modal-body">
									
                            <!--Start of Form-->
                            <form>
                                {{ csrf_field() }}
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{$entry->name}}" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="phone">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{$entry->phone}}" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{$entry->email}}" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="gender">Gender</label>
                                            <select class="form-control" id="gender" name="gender" readonly>
                                                <option @if($entry->gender=='Male') {{ 'selected' }} @endif readonly>Male</option>
                                                <option @if($entry->gender=='Female') {{ 'selected' }} @endif readonly>Female</option>
                                            </select>
                                    </div>
                                
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail">Age</label>
                                            <input type="integer" class="form-control" id="age" name="age" value="{{$entry->age}}" readonly>
                                    </div>
                                </div>    
                            </form>
						</div>
					</div>
                </div>
            </div>
            @endforeach

@endsection