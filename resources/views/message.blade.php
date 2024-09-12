@if (Session::has('successlogin'))
    <script>
        swal("Welcome {{ Auth::user()->name }}!", "{{ Session::get('successlogin') }}", 'success', {
            button: true,
            button: "OK",
        })
    </script>
@endif



@if (Session::has('success'))
    <script>
        swal("Done!!", "{{ Session::get('success') }}", 'success', {
            button: true,
            button: "OK",
        })
    </script>
@endif


<script>
     // Use the SweetAlert confirmation for dynamically added extra fields
     document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-extra-field')) {
            // Show SweetAlert confirmation dialog
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this field!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    // Remove the extra field if the user confirms
                    e.target.parentElement.remove();
                }
            });
        }
    });
</script>

<script>
    function confirmDelete(url) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                // Submit the form by updating the form's action URL
                document.getElementById('delete-form').action = url;
                document.getElementById('delete-form').submit();
            }
        });
    }
</script>

@if (Session::has('delete'))
    <script>
        swal("Done!!", "{{ Session::get('delete') }}", 'success', {
            button: "OK",
        });
    </script>
@endif


@if (Session::has('error'))
    <script>
        swal("Oops...", "{{ Session::get('error') }}", 'error', {
            button: true,
            button: "OK",
        })
    </script>
@endif
