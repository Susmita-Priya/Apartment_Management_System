




// $(document).on("click", "#delete", function (e) {
//     e.preventDefault();
//     var link = $(this).attr("href");
    

//     Swal.fire({
//         title: 'Are you sure?',
//         // text: "You won't be able to Delete this!",
//         icon: 'question',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes, Delete it!'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             window.location.href = link;
//             // Swal.fire(
//             //     'Deleted!',
//             //     'Your file has been deleted.',
//             //     'success'              
//             // )
//         }else{
//             Swal.fire(
//                 'Cancelled!',
//                 'Your imaginary file is safe.',
//                 'error'
//             )
//         }
//     });

// });


        // //Success Message
        // $(document).ready(function() {
        //     // Check if there is a success message in the session
        //     if (session('success')){
        //          swal({
        //             title: 'Successful!',
        //             text: 'New User Been Created !',
        //             type: 'success',
        //             confirmButtonColor: '#4fa7f3'
        //         }).then((result) => {
        //             if (result.isConfirmed) {
        //                 // Redirect to the URL
        //                 window.location.href = "{{ route('user.index') }}";
        //             }
        //         });
        //     }
               
        // });
        


        //     //Success Message
        //     $(document).on("click", "#sa-success-updateuser", function (e) {
        //         e.preventDefault();
        //         var link = $(this).attr("href");
        //         swal({
        //                 title: 'Successfull!',
        //                 text: 'User details have been updated !',
        //                 type: 'success',
        //                 confirmButtonColor: '#4fa7f3'
    
        //             }).then((result) => {
        //         if (result.isConfirmed) {
        //             window.location.href = link;
        //         }
        //     });
    
        // });
        





    
        $(document).on("click", "#view", function (e) {
                e.preventDefault();
                var link = $(this).attr("href");
                var fullname = $(this).data("fullname");
                var email = $(this).data("email");
                var phn = $(this).data("phn");
                var idno = $(this).data("idno");
                var address = $(this).data("address");
                var occStatus = $(this).data("occ-status");
                var occPlace = $(this).data("occ-place");
                var emname = $(this).data("emname");
                var emphn = $(this).data("emphn");
                swal({
                    title: 'User Information',
                    html: '<p>Full Name: ' + fullname + '</p>' +
                          '<p>Email: ' + email + '</p>' +
                          '<p>Phone: ' + phn + '</p>' +
                          '<p>ID Number: ' + idno + '</p>' +
                          '<p>Address: ' + address + '</p>' +
                          '<p>Occupation Status: ' + occStatus + '</p>' +
                          '<p>Occupation Place: ' + occPlace + '</p>' +
                          '<p>Emergency Contact Name: ' + emname + '</p>' +
                          '<p>Emergency Contact Phone: ' + emphn + '</p>',
                    width: 600,
                    padding: 100,
                    background: '#fff url(//subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/geometry.png)'
                }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = link;
                                }
                            });
        });







//         $(document).ready(function() {
//     $('form').on('submit', function(e) {
//         e.preventDefault(); // Prevent the default form submission

//         var form = $(this);
//         var url = form.attr('action');

//         $.ajax({
//             type: "POST",
//             url: url,
//             data: form.serialize(),
//             success: function(response) {
//                 if (response.success) {
//                     Swal.fire({
//                         title: 'Successful!',
//                         text: response.message,
//                         icon: 'success',
//                         confirmButtonColor: '#4fa7f3'
//                     }).then((result) => {
//                         if (result.isConfirmed) {
//                             window.location.href = '/user'; // Redirect to the user page
//                         }
//                     });
//                 }
//             },
//             error: function(response) {
//                 // Handle error if needed
//             }
//         });
//     });
// });