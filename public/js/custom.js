///////////////// asset show modal///////////

document.addEventListener('DOMContentLoaded', function () {
    // When a room card is clicked
    document.querySelectorAll('.room-card').forEach(card => {
        card.addEventListener('click', function () {
            const roomId = this.getAttribute('data-roomid');
            const roomType = this.getAttribute('data-roomtype');
            const assetId = this.getAttribute('data-assetid'); // Get the asset ID

            // Open the modal
            $('#assetModal').modal('show');

            // Clear previous content
            document.getElementById('assetContent').innerHTML = 'Loading...';

             // If there is no assetId, display a message in the modal
             if (!assetId) {
                document.getElementById('assetContent').innerHTML = 'No assets found for this room.';
                document.getElementById('edit-button').style.display = 'none';
                document.getElementById('delete-button').style.display = 'none';
            } else {

            // Fetch the asset data
            fetch(`/asset/show/${assetId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('assetContent').innerHTML = html;
                })
                .catch(error => {
                    console.error('Error fetching assets:', error);
                    document.getElementById('assetContent').innerHTML = 'Error loading assets.';
                });

            // Set the edit and delete URLs dynamically
            document.getElementById('edit-button').href = `/asset/edit/${assetId}`;
            document.getElementById('delete-button').onclick = function () {
                confirmDelete(`/asset/delete/${assetId}`);
            }; 
              // Show buttons
              document.getElementById('edit-button').style.display = 'inline-block';
              document.getElementById('delete-button').style.display = 'inline-block';
          }
        });
    });
});




//  this portion for image instant change 
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block'; // Show the image
            };

            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '';
            imagePreview.style.display = 'none'; // Hide the image if no file is selected
        }
    });
});




// Image instant show for dynamic field
document.addEventListener('change', function(event) {
    if (event.target.classList.contains('asset-image-input')) {
        const fileInput = event.target;
        const imagePreview = fileInput.closest('.asset-item').querySelector('.imagePreview');

        const file = fileInput.files[0]; // Get the selected file

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result; // Set the image preview source to the file data
                imagePreview.style.display = 'block'; // Show the image preview
            };

            reader.readAsDataURL(file); // Convert the file into a data URL
        } else {
            imagePreview.src = ''; // Clear the image preview if no file is selected
            imagePreview.style.display = 'none'; // Hide the image preview
        }
    }
});