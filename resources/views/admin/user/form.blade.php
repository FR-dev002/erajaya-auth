<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Form Add user</h5>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('user')}}" method="POST" id="form_user">
                    {{ csrf_field() }}

                    <input type="hidden" name="id" value="{{ (isset($data) ? $data->id : old('id')) }}" id="form_id">
                    <div class="col-md-12 row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Name
                                </label>
                                <input type="text" name="name" id="form_name" class="form-control form-control-sm @error('name') is-invalid @enderror" value="{{ (isset($data) ? $data->name : old('name')) }}" placeholder="Nama Depan">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">E-mail
                                </label>
                                <input type="email" name="email" id="form_email" class="form-control  form-control-sm @error('email') is-invalid @enderror" value="{{ (isset($data) ? $data->email : old('email')) }}" placeholder="E-Mail">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">password
                                </label>
                                <input type="password" name="password" id="form_password" class="form-control  form-control-sm @error('password') is-invalid @enderror" value="{{ (isset($data) ? $data->password : old('password')) }}" placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="exampleInputPassword1">Role
                                </label>
                                <select class="form-control form-control-sm select2" name="role" id="form_role" style="width: 100%;">
                                    @foreach($roles as $key => $value)
                                    @if($key < 1) { <option value="" {{isset($data) ? '':'selected'}}> --
                                        Role
                                        -- </option>
                                        }
                                        @endif

                                        @if(old('role') == $value->id) {
                                        <option selected value="{{$value->id}}">
                                            {{$value->name}}
                                        </option>
                                        }
                                        @endif

                                        @if(isset($data))
                                        @if($data->id == $value->id ||
                                        old('role') == $value->id)
                                        <option selected value="{{$value->id}}">
                                            {{$value->name}}
                                        </option>
                                        @else
                                        <option value="{{$value->id}}">
                                            {{$value->name}}
                                        </option>
                                        @endif

                                        @else
                                        <option value="{{$value->id}}">
                                            {{$value->name}}
                                        </option>
                                        @endif
                                        @endforeach
                                </select>

                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <div class="text-center">
                        <input type="submit" id="btn_save" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@push('fileCSSCustom')
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endpush


@push('fileJsCustome')

<!-- Validation -->
<!-- jquery-validation -->
<script src="{{asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script>
    $('#form_user').validate({
        rules: {
            name: {
                required: true,
            },
            password: {
                required: true
            },
            role: {
                required: true
            },
            email: {
                required: true,
                email: true,
            }
        },
        messages: {
            name: {
                required: "Name is required ",
            },
            password: {
                required: "Password is required",
            },
            role: {
                required: "Role is required",
            },
            email: {
                required: "Alamat email mohon di isi",
                email: "Format email salah"
            }
        },

        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },

        // submitHandler: function(form) {
        // }
    });
</script>

<!-- SweetAlert2 -->
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>

@endpush