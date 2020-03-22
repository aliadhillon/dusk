@if (Session::has('msg'))
    <div class="alert alert-success">
        <p>{{ Session::get('msg') }}</p>
    </div>
@endif