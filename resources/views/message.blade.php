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
        let successMessage = `{!! Session::get('success') !!}`;
        swal({
            title: "Done!!",
            content: (function() {
                var div = document.createElement("div");
                div.innerHTML = successMessage; // Render HTML
                return div;
            })(),
            icon: "success",
            button: "OK",
        });
    </script>
@endif



{{-- remove extra fields --}}
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


{{-- remove extra asset --}}
<script>
    // Use the SweetAlert confirmation for dynamically added extra fields
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-asset')) {
            // Show SweetAlert confirmation dialog
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this field!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    // Remove asset row
                        if (e.target.classList.contains('remove-asset')) {
                            e.target.closest('.asset-item').remove();
                        }
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
        swal("Sorry !!", "{{ Session::get('error') }}", 'error', {
            button: true,
            button: "OK",
        })
    </script>
@endif
