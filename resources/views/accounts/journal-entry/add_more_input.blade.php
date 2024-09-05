<tr>
    <td>
        <select name="account_id[]" id="account_id" class="form-control" required>
            <option value="">Slect One</option>
            @if (!empty($accounts))
                @foreach ($accounts as $key => $account)
                    <option value="{{ $account->id ?? '' }} ">
                        {{ $account->account_title ?? '' }}
                        ({{ $account->account_no ?? '' }})
                    </option>
                @endforeach
            @endif
        </select>
    </td>

    <td>
        <select name="account_group_id[]" class="form-control account_group_id" index_no="{{ $index_count }}" required>
            <option value="">Slect One</option>
            @if (!empty($account_groups))
                @foreach ($account_groups as $key => $account_group)
                    <option value="{{ $account_group->id ?? '' }}" group_type="{{ $account_group->group_type ?? 0 }}">
                        {{ $account_group->name ?? '' }}
                    </option>
                @endforeach
            @endif
        </select>
    </td>
    <td>
        <input type="number" name="debit[]" class="form-control debit" id="debit_{{ $index_count }}">
    </td>
    <td>
        <input type="number" name="credit[]" class="form-control credit" id="credit_{{ $index_count }}">
    </td>
    <td> <a href="#" class="btn btn-danger remove_button"> <i class="fa fa-close"></i> </a></td>
</tr>
