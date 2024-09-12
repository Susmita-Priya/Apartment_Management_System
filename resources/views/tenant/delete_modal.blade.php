<!-- Modal for delete -->
<div class="modal fade" id="delete{{ $renter->r_id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <br>
            </div>

            <div class="modal-body">
                <form action="{{ route('delete-renter', $renter->r_id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <h6>Are you sure you want to delete?</h6>
                    <hr>
                    <div class="pull-right">
                        <input type="submit" name="btn" class="btn btn-danger"
                            value="Yes">

                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">No</button>
                    </div>
                    <!-- <input type="submit" name="btn" class="btn btn-danger pull-right" value="delete"> -->
                </form>
            </div>
        </div>
    </div>
</div>