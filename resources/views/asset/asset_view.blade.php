@if($assets->isEmpty())
    <p>No assets found for this room.</p>
@else
    <ul class="list-group">
        @foreach($assets as $asset)
            <li class="list-group-item">
                <strong>{{ $asset->asset_name }}:</strong> {{ $asset->quantity }}
            </li>
        @endforeach
    </ul>
@endif
