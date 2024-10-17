
<!DOCTYPE html>
<html lang="en">
@include('layouts/header') 
<body class="g-sidenav-show   bg-primary">
  <!-- <div class="min-height-full bg-primary position-absolute w-100"></div> -->
  @include('layouts/sidenav')
  <main class="main-content position-relative border-radius-lg ">
    @include('layouts/navbar')
    @yield('content')
  </main>
 
  @include('layouts/mainScripts')  

  
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>

$(document).ready(function() {

    $('#userTable').DataTable(); // Initialize DataTables
    $('#ticketTable').DataTable(); 
    // Handle Edit button click
    $('.edit-btn').on('click', function () {
        const userId = $(this).data('id'); // Get the user ID

        // Fetch user data to populate the edit form
        $.get(`/admin/users/${userId}/edit`, function (user) {
          $('#editUserId').val(user.id);
            $('#editName').val(user.name);
            $('#editEmail').val(user.email);
            $('#editRole').val(user.role);
      
            $('#userEditForm').attr('action', `/admin/users/${userId}`);
            $('#userEditModal').modal('show'); // Show the edit user modal
        });
    });

    // Handle form submission
    $('#userForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Serialize form data
        const formData = $(this).serialize();

        // Send an AJAX request to update the user
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'), // The action URL set in the form
            data: formData,
            success: function(response) {
                // Handle the success response (e.g., show a success message)
               //#00b09b alert('User created successfully!');
                Toastify({
                    text: response.success,
                    duration: 3000, // Duration in milliseconds
                    gravity: "top", // `top` or `bottom`
                    position: 'right', // `left`, `center` or `right`
                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)", // Custom background color
                    stopOnFocus: true // Prevents dismissal on hover
                }).showToast();
                // Reload the user table or refresh the page
                location.reload(); // You can also refresh the table data here
            },
            error: function(xhr) {
                // Handle error response (e.g., show validation errors)
                let errors = xhr.responseJSON.errors;
                let errorMsg = '';
                for (let key in errors) {
                    errorMsg += errors[key].join(', ') + '\n';
                }
                Toastify({
                text: 'Errors:\n' + errorMsg,
                duration: 3000,
                backgroundColor: "red",
            }).showToast();
            }
        });
    });

    $('#userEditForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Serialize form data
        const formData = $(this).serialize();

        // Send an AJAX request to update the user
        $.ajax({
            type: 'PUT',
            url: $(this).attr('action'), // The action URL set in the form
            data: formData,
            success: function(response) {
                // Handle the success response (e.g., show a success message)
                Toastify({
                    text: response.success,
                    duration: 3000, // Duration in milliseconds
                    gravity: "top", // `top` or `bottom`
                    position: 'right', // `left`, `center` or `right`
                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)", // Custom background color
                    stopOnFocus: true // Prevents dismissal on hover
                }).showToast();
                
                // Reload the user table or refresh the page
                $('#userEditModal').modal('hide'); // Close the modal
                location.reload(); 
            },
            error: function(xhr) {
                // Handle error response (e.g., show validation errors)
                let errors = xhr.responseJSON.errors;
                let errorMsg = '';
                for (let key in errors) {
                    errorMsg += errors[key].join(', ') + '\n';
                }
                Toastify({
                text: 'Errors:\n' + errorMsg,
                duration: 3000,
                backgroundColor: "red",
            }).showToast();
              
            }
        });
    });

// Show image preview when a file is selected
$('#editTicketPic').on('change', function (e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            $('#ticketPicPreview')
                .attr('src', e.target.result)
                .removeClass('d-none'); // Show the image preview
        };
        reader.readAsDataURL(file);
    }
});

// Open the modal and populate fields
$('.ticket-edit-btn').on('click', function () {
    const ticketId = $(this).data('id'); // Get the ticket ID

    // Fetch ticket data to populate the edit form
    $.get(`/ticket/${ticketId}/edit`, function (ticket) {
        $('#editTicketId').val(ticket.id);
        $('#editTicketFirstName').val(ticket.firstname);
        $('#editTicketLastName').val(ticket.lastname);
        $('#editTicketLicensePlateNumber').val(ticket.license_plate_number);
        $('#editTicketCitationNumber').val(ticket.citation_number);
        $('#editTicketTotalAmountOwed').val(ticket.total_amount_owed);
        $('#editTicketPrice').val(ticket.price);

        // Set image preview if available
        if (ticket.ticket_pic) {
            $('#ticketPicPreview')
                .attr('src', `/storage/${ticket.ticket_pic}`)
                .removeClass('d-none'); // Show the image preview
        } else {
            $('#ticketPicPreview').addClass('d-none'); // Hide the image preview if not available
        }

        // Set form action for the update request
        $('#ticketEditForm').attr('action', `/ticket/${ticketId}`);
        $('#ticketEditModal').modal('show'); // Show the modal
    });
});
$('#ticketEditForm').on('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    const form = $(this);
    const actionUrl = form.attr('action');
    const formData = new FormData(this); // Use FormData to handle file uploads

    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            Toastify({
                text: "Ticket updated successfully!",
                duration: 3000,
                backgroundColor: "green",
            }).showToast();
           $('#ticketEditModal').modal('hide');
            location.reload(); // Reload the page to reflect changes
        },
        error: function (response) {
            Toastify({
                text: "Failed to update ticket. Please try again.",
                duration: 3000,
                backgroundColor: "red",
            }).showToast();
        }
    });
});



 // Show image preview
 $('#ticket_pic').on('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#addTicketPicPreview')
                    .attr('src', e.target.result)
                    .removeClass('d-none'); // Show the preview
            };
            reader.readAsDataURL(file);
        }
    });

    // Handle form submission via AJAX
    $('#ticketForm').on('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('ticket.store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // Close the modal and reset the form
                $('#ticketModal').modal('hide');
                $('#ticketForm')[0].reset();
                $('#addTicketPicPreview').addClass('d-none'); // Hide the preview

                // Show success notification
                Toastify({
                    text: "Ticket added successfully!",
                    duration: 3000,
                    backgroundColor: "green",
                }).showToast();

                // Optionally: Reload the ticket list or append the new ticket to the list
                 location.reload(); 
            },
            error: function (xhr) {
                let errors = xhr.responseJSON?.errors;
                let errorMessage = "An error occurred. Please try again.";
                
                if (errors) {
                    // Extract the first error message from the response
                    errorMessage = Object.values(errors)[0][0];
                }

                Toastify({
                    text: errorMessage,
                    duration: 3000,
                    backgroundColor: "red",
                }).showToast();
            }
        });
    });

});


</script>
</body>
</html>