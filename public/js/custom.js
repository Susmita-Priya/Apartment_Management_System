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

            // Fetch the asset data
            fetch(`/asset/show/${roomId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('assetContent').innerHTML = html;
                })
                .catch(error => {
                    console.error('Error fetching assets:', error);
                    document.getElementById('assetContent').innerHTML = 'Error loading assets.';
                });

            // Set the edit and delete URLs dynamically
            document.getElementById('edit-button').href = `/asset/edit/${assetId}/${roomType}`;
            document.getElementById('delete-button').onclick = function () {
                confirmDelete(`/asset/delete/${assetId}`);
            };
        });
    });
});


// document.getElementById('add-room-field').addEventListener('click', function() {
//     let div = document.createElement('div');
//     div.classList.add('form-group');
//     div.classList.add('dynamic-room');

//     div.innerHTML = `
// <label for="room_name">Room Name</label>
// <input type="text" name="extra_rooms[${index}][room_name]" class="form-control" placeholder="Enter room name">
// <label for="quantity">How Many?</label>
// <input type="number" name="extra_rooms[${index}][quantity]" class="form-control" placeholder="Enter number of rooms">
// <button type="button" class="btn btn-danger mt-2 remove-extra-field">Remove</button>
// `;

//     document.getElementById('dynamic-room-fields').appendChild(div);
//     index++;
// });



