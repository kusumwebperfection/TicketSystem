@extends('admin/adminMaster')
@section('title', 'List Ticket')
@section('breadcrumbs')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item text-sm text-white active" aria-current="page">List Ticket</li>
</ol>
@endsection
@section('content')
<div class="container">
    <h1 class="text-white">List Ticket</h1>


    @if(\App\Helpers\RoleHelper::hasRole('admin'))
    <div class="row" bis_skin_checked="1">
        <div class="col-md-12 text-start my-3" bis_skin_checked="1">
            <a class="btn bg-gradient-dark mb-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#ticketModal"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp; Add Tickets</a>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tickets</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-4">
                        <table class="table align-items-center mb-0" id="ticketTable">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder">ID</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder  ps-2">First Name</th>
                                    <th class="text-center text-uppercase text-secondary text-md font-weight-bolder">Last Name</th>
                                    <th class="text-center text-uppercase text-secondary text-md font-weight-bolder">Citation Number</th>
                                    <th class="text-center text-uppercase text-secondary text-md font-weight-bolder">License Plate Number</th>
                                    <th class="text-center text-uppercase text-secondary text-md font-weight-bolder">Total Amount Owed</th>
                                    <th class="text-center text-uppercase text-secondary text-md font-weight-bolder">Price</th>
                                    <th class="text-center text-uppercase text-secondary text-md font-weight-bolder">Ticket Pic</th>
                                    @if(\App\Helpers\RoleHelper::hasRole('admin'))
                                    <th class="text-center text-uppercase text-secondary text-md font-weight-bolder">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($Ticket as $index => $ticket)
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $ticket->firstname ?? 'N/A' }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $ticket->lastname ?? 'N/A' }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $ticket->citation_number ?? '-' }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $ticket->license_plate_number ?? '-' }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $ticket->total_amount_owed ?? '0.00' }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $ticket->Price ?? '0.00' }}</p>
                                    </td>
                                    <td>
                                        <img src="{{ $ticket->ticket_pic ? asset('storage/' . $ticket->ticket_pic) : asset('images/placeholder.png') }}"
                                            alt="{{ $ticket->firstname ?? 'No Image' }}"
                                            width="100px" height="100px">
                                    </td>

                                    @if(\App\Helpers\RoleHelper::hasRole('admin') || \App\Helpers\RoleHelper::hasRole('sub_admin'))
                                    <td class="align-middle">
                                        <a class="btn btn-link text-success px-3 mb-0 ticket-edit-btn"
                                            href="javascript:;"
                                            data-id="{{ $ticket->id }}">
                                            <i class="fas fa-pencil-alt text-success me-2" aria-hidden="true"></i>Edit
                                        </a>

                                        <form action="{{ route('ticket.destroy', $ticket->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-link text-danger px-3 mb-0"
                                                onclick="return confirm('Are you sure?')"
                                                style="border: none; background: none;">
                                                <i class="far fa-trash-alt me-2" aria-hidden="true"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pagination -->
    {{ $Ticket->links() }}

    <!-- User Modal -->
    <div class="modal fade" id="ticketModal" tabindex="-1" aria-labelledby="ticketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="ticketForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ticketModalLabel">Add Ticket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                        </div>

                        <div class="mb-3">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>

                        <div class="mb-3">
                            <label for="license_plate_number" class="form-label">License Plate Number</label>
                            <input type="text" class="form-control" id="license_plate_number" name="license_plate_number" required>
                        </div>

                        <div class="mb-3">
                            <label for="citation_number" class="form-label">Citation Number</label>
                            <input type="text" class="form-control" id="citation_number" name="citation_number" required>
                        </div>

                        <div class="mb-3">
                            <label for="total_amount_owed" class="form-label">Total Amount Owed</label>
                            <input type="number" step="0.01" class="form-control" id="total_amount_owed" name="total_amount_owed" required>
                        </div>

                        <div class="mb-3">
                            <label for="ticket_pic" class="form-label">Ticket Picture</label>
                            <input type="file" class="form-control" id="ticket_pic" name="ticket_pic" accept="image/*" required>
                            <img id="addTicketPicPreview" src="#" alt="Ticket Picture" class="img-fluid mt-2 d-none" style="max-height: 150px;">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Ticket</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" id="ticketEditModal" tabindex="-1" aria-labelledby="ticketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="ticketEditForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Ensure PUT method for updating resources -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ticketModalLabel">Edit Ticket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editTicketId" name="ticket_id">

                        <div class="mb-3">
                            <label for="editTicketFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="editTicketFirstName" name="firstname" required>
                        </div>

                        <div class="mb-3">
                            <label for="editTicketLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="editTicketLastName" name="lastname" required>
                        </div>

                        <div class="mb-3">
                            <label for="editTicketLicensePlateNumber" class="form-label">License Plate Number</label>
                            <input type="text" class="form-control" id="editTicketLicensePlateNumber" name="license_plate_number" required>
                        </div>

                        <div class="mb-3">
                            <label for="editTicketCitationNumber" class="form-label">Citation Number</label>
                            <input type="text" class="form-control" id="editTicketCitationNumber" name="citation_number" required>
                        </div>

                        <div class="mb-3">
                            <label for="editTicketTotalAmountOwed" class="form-label">Total Amount Owed</label>
                            <input type="number" step="0.01" class="form-control" id="editTicketTotalAmountOwed" name="total_amount_owed" required>
                        </div>

                        <div class="mb-3">
                            <label for="editTicketPrice" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="editTicketPrice" name="price" required>
                        </div>

                        <div class="mb-3">
                            <label for="editTicketPic" class="form-label">Ticket Picture</label>
                            <input type="file" class="form-control" id="editTicketPic" name="ticket_pic" accept="image/*">
                            <img id="ticketPicPreview" src="#" alt="Ticket Picture" class="img-fluid mt-2 d-none" style="max-height: 150px;">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    @if (session('success'))
    <script>
        Toastify({
            text: "{{ session('success') }}",
            duration: 3000, // Duration in milliseconds
            gravity: "top", // `top` or `bottom`
            position: 'right', // `left`, `center` or `right`
            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)", // Background color
            stopOnFocus: true, // Prevents dismissing of toast on hover
            onClick: function() {} // Callback after click
        }).showToast();
    </script>
    @endif
    @endsection