@if($assets->isEmpty())
    <p>No assets found for this room.</p>
@else
    <ul class="list-group">
        @foreach($assets as $asset)
            @foreach($asset->assets_details as $detail)
                  <p> &nbsp; <strong>{{ $detail['asset_name'] }}:</strong> {{ $detail['quantity'] }} </p>
            @endforeach
        @endforeach 
    </ul>
    {{-- @php
    $id = $asset->id
    @endphp --}}
    {{-- <div class ="modal-footer">
        <a id="edit-button" href="{{ route('asset.edit', ['id' => $asset->id ,'room_type'=> $room]) }}" class="btn btn-primary">
            Edit Asset
        </a>

        <!-- Delete button -->
        <button type="button" class="btn btn-danger" id="delete-button">
            Delete Asset
        </button>
    </div> --}}
   
@endif
