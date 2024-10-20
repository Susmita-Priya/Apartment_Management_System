
<div class="modal-body">
    @if ($details)
        @foreach ($details as $detail)
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>{{ $detail['name'] }}:</strong> {{ $detail['quantity'] }}

                    @if (!empty($detail['image']))
                        <br>
                        <img src="{{ asset($detail['image']) }}" alt="Asset Image" style="max-width: 100%; height: auto;">
                    @endif
                </li>
            </ul>
        @endforeach
    @else
        <p>No assets found for this room.</p>
    @endif
</div>
