@if (\Session::has('success'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-xs alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">&times;</button>
                    {!! \Session::get('success') !!}
            </div>
        </div>
    </div>
@endif

