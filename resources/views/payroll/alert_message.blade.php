@if (Session::has('success'))
    <p class="alert {{ Session::get('alert-class', 'alert-primary') }}">{{ Session::get('success') }}</p>
@endif
@if (Session::has('delete'))
    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('delete') }}</p>
@endif
