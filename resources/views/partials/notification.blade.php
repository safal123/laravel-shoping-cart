<div class="container">
  @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show ml-4" role="alert">
      <strong>{{ Session::get('success') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @elseif(Session::has('alert'))
      <div class="alert alert-danger alert-dismissible fade show ml-4" role="alert">
        <strong>{{ Session::get('alert') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
</div>