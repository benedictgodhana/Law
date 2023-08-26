@extends('layout/layout')

@section('space-work')
 <br><br>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addClientModal"><i class="fa fa-user"></i>
    Add Client
</button><br><br>

<div style="margin-left:150px; margin-top:-63px">
    <a href="{{ route('generate.client.report') }}" class="btn btn-warning">
        <i class="fa fa-file-pdf-o"></i> Generate Client Report
    </a>


</div><br>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Contact</th>
                <th>D.O.B</th>
                <th>Details</th>
                <th>Status</th>
                <th>Relevant Dates</th>
                <th>Case Description</th>
                <th>Notes</th>
                <th class="d-none d-md-table-cell">Created at</th>
                <th class="d-none d-md-table-cell">Updated at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
            <tr>
                <td>
                    @if ($client->image)
                    <img src="data:image/png;base64,{{ $client->image }}" alt="Client Image" width="60">
                    @else
                    No Image
                    @endif
                </td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->contact_info }}</td>
                <td>{{ $client->date_of_birth }}</td>
                <td>{{ $client->case_details}}</td>
                <td>{{ $client->case_status }}</td>
                <td>{{ $client->relevant_dates}}</td>
                <td>{{ $client->case_description}}</td>
                <td>{{ $client->notes}}</td>

                <td class="d-none d-md-table-cell">{{ $client->created_at}}</td>
                <td class="d-none d-md-table-cell">{{ $client->updated_at}}</td>
                <td>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#viewModal{{ $client->id }}">View</a>
                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $client->id }}">Edit</a>
                    <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $client->id }}">Delete</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@foreach ($clients as $client)
<!-- Modal for Viewing Client -->
<div class="modal fade" id="viewModal{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">View Client Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> {{ $client->name }}</p>
                <p><strong>Contact Information:</strong> {{ $client->contact_info }}</p>
                <p><strong>Date of Birth:</strong> {{ $client->date_of_birth }}</p>
                <p><strong>Case details:</strong> {{ $client->case_details }}</p>
                <p><strong>Case Status:</strong> {{ $client->case_status }}</p>
                <p><strong>Relevant Dates:</strong> {{ $client->relevant_dates }}</p>
                <p><strong>Case description:</strong> {{ $client->case_description }}</p>
                <p><strong>Relevant Dates:</strong> {{ $client->notes}}</p>
                @if ($client->image)
                <img src="data:image/png;base64,{{ $client->image }}" alt="Client Image" width="100">
                @else
                No Image
                @endif
                <p><strong>Created at:</strong> {{ $client->created_at}}</p>
                <p><strong>Updated at:</strong> {{ $client->updated_at}}</p>





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal for Editing Client -->
<div class="modal fade landscape-modal" id="editModal{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Client Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Include a form with input fields to edit client details -->
                <form method="POST" action="{{ route('sub-admin.clients.update', ['client' => $client->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="contact_info">Contact Info</label>
                                <input type="text" class="form-control" id="contact_info" name="contact_info" value="{{ $client->contact_info }}" required>
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $client->date_of_birth }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="case_details">Case Details</label>
                                <textarea class="form-control" id="case_details" name="case_details" rows="3">{{ $client->case_details }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="case_status">Case Status</label>
                                <input type="text" class="form-control" id="case_status" name="case_status" value="{{ $client->case_status }}">
                            </div>
                            <div class="form-group">
                                <label for="relevant_dates">Relevant Dates</label>
                                <input type="text" class="form-control" id="relevant_dates" name="relevant_dates" value="{{ $client->relevant_dates }}">
                            </div>
                            <div class="form-group">
                                <label for="case_description">Case Description</label>
                                <textarea class="form-control" id="case_description" name="case_description" rows="3">{{ $client->case_description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3">{{ $client->notes }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>

                            <!-- Include other input fields for editing other client attributes -->
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Adding Client -->
<div class="modal fade landscape-modal" id="addClientModal" tabindex="-1" role="dialog" aria-labelledby="addClientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClientModalLabel">Add New Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Include a form with input fields to add client details -->
                <form method="POST" action="{{ route('sub-admin.clients.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="contact_info">Contact Info</label>
                                <input type="text" class="form-control" id="contact_info" name="contact_info" required>
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="case_details">Case Details</label>
                                <textarea class="form-control" id="case_details" name="case_details" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="case_status">Case Status</label>
                                <input type="text" class="form-control" id="case_status" name="case_status">
                            </div>
                            <div class="form-group">
                                <label for="relevant_dates">Relevant Dates</label>
                                <input type="text" class="form-control" id="relevant_dates" name="relevant_dates">
                            </div>
                            <div class="form-group">
                                <label for="case_description">Case Description</label>
                                <textarea class="form-control" id="case_description" name="case_description" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>

                            <!-- Include other input fields for adding other client attributes -->
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Client</button>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach ($clients as $client)
<!-- Modal for Deleting Client -->
<div class="modal fade" id="deleteModal{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the client: <strong>{{ $client->name }}</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="{{ route('sub-admin.clients.destroy', $client) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endforeach

@endsection