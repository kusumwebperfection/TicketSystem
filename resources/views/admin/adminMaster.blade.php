
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
                alert('User created successfully!');
                
                // Reload the user table or refresh the page
                //location.reload(); // You can also refresh the table data here
            },
            error: function(xhr) {
                // Handle error response (e.g., show validation errors)
                let errors = xhr.responseJSON.errors;
                let errorMsg = '';
                for (let key in errors) {
                    errorMsg += errors[key].join(', ') + '\n';
                }
                alert('Errors:\n' + errorMsg);
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
                alert('User updated successfully!');
                
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
                alert('Errors:\n' + errorMsg);
            }
        });
    });

 
});


</script>
</body>
</html>