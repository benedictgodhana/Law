@extends('layout/layout')

@section('space-work')
<br><br>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDocumentModal">
    <i class="fa fa-file-pdf-o"></i> Add Document
</button><br><br>

<div style="margin-left:170px; margin-top:-63px">
    <a href="{{ route('generate.client.report') }}" class="btn btn-warning">
        <i class="fa fa-file-pdf-o"></i> Generate Client Report
    </a>


</div><br>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Document</th>
                <th>Client Name</th>
                <th>Document Name</th>
                <th>Document Type</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Upload Date</th>
                <th class="d-none d-md-table-cell">Created at</th>
                <th class="d-none d-md-table-cell">Updated at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $document)
            <tr>
                <td>
                    <a href="{{ asset($document->document_file) }}" target="_blank">View Document</a>
                </td>
                <td>{{ $document->client->name }}</td>
                <td>{{ $document->document_name }}</td>
                <td>{{ $document->document_type }}</td>
                <td>{{ $document->status }}</td>
                <td>{{ $document->notes }}</td>
                <td>{{$document->upload_date}}</td>
                <td class="d-none d-md-table-cell">created_at</td>
                <td class="d-none d-md-table-cell">updated_at</td>
                <td>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#viewModal">View</a>
                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editModal">Edit</a>
                    <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal for Viewing Client -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">View Client Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong></p>
                <p><strong>Contact Information:</strong></p>
                <p><strong>Date of Birth:</strong></p>
                <p><strong>Case details:</strong></p>
                <p><strong>Case Status:</strong></p>
                <p><strong>Relevant Dates:</strong></p>
                <p><strong>Case description:</strong></p>
                <p><strong>Relevant Dates:</strong></p>
                <p><strong>Created at:</strong></p>
                <p><strong>Updated at:</strong></p>





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal for Editing Client -->
<div class="modal fade landscape-modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
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
                <form method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="contact_info">Contact Info</label>
                                <input type="text" class="form-control" id="contact_info" name="contact_info" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="case_details">Case Details</label>
                                <textarea class="form-control" id="case_details" name="case_details" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="case_status">Case Status</label>
                                <input type="text" class="form-control" id="case_status" name="case_status" value="">
                            </div>
                            <div class="form-group">
                                <label for="relevant_dates">Relevant Dates</label>
                                <input type="text" class="form-control" id="relevant_dates" name="relevant_dates" value="">
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

                            <!-- Include other input fields for editing other client attributes -->
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Adding Document -->
<div class="modal fade landscape-modal" id="addDocumentModal" tabindex="-1" role="dialog" aria-labelledby="addDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDocumentModalLabel">Upload Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Include a form with input fields to add document details -->
                <form method="POST" action="{{ route('upload.document') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="client_id">Client Name</label>
                                <select class="form-control" id="client_id" name="client_id" required>
                                    <option value="" selected disabled>Select a client</option>
                                    @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="advocate_name">Advocate Name</label>
                                <input type="text" class="form-control" id="advocate_id" name="advocate_id" value="{{ auth()->user()->name }}" readonly>
                                <input type="hidden" name="advocate_id" value="{{ auth()->user()->advocate_id }}">
                            </div>
                            <div class="form-group">
                                <label for="document_name">Document Name</label>
                                <input type="text" class="form-control" id="document_name" name="document_name" required>
                            </div>
                            <div class="form-group">
                                <label for="document_type">Document Type</label>
                                <input type="text" class="form-control" id="document_type" name="document_type">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" class="form-control" id="status" name="status">
                            </div>
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="file_path">File Path</label>
                                <input type="hidden" class="form-control" id="file_path" name="file_path" value="">
                            </div>
                            <div class="form-group">
                                <label for="upload_date">Upload Date</label>
                                <input type="date" class="form-control" id="upload_date" name="upload_date" required>
                            </div>
                            <div class="form-group">
                                <label for="document_file">Upload Document File</label>
                                <input type="file" class="form-control-file" id="document_file" name="document_file" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Upload Document</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Deleting Client -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the client: <strong></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection