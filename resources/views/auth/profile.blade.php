@extends('layouts.app')
@section('title', 'Pengaturan Profil')

@section('content')



<div class="card">
    <div class="card-header">
        @if (session('successMessage'))

        <strong id="successMessage" hidden>{{ session('successMessage') }}</strong>

        @elseif(session('errorMessage'))

        <strong id="errorMessage" hidden>{{ session('errorMessage') }}</strong>

        @endif
        <div class="row">
            <div class="col-md-6">
                <h3 class="h3">Profil</h3>
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>
    <div class="card-body">

        <form action="{{ url('profile/update/') }}/{{Auth::user()->id}}" method="POST" id="addForm"
            enctype="multipart/form-data" data-parsley-validate>
            @csrf
            <div class="modal-body">
                <div class="form-body">

                    <div class="row">
                        {{-- <div class="col-md-4 mb-3">
                            <div class="text-center">
                                @if(Auth::user()->image == NULL)
                                <img alt="profile" src="img/avatars/profile.jpg"
                                    class="rounded-circle img-responsive mt-2" width="200" height="200" />
                                @else
                                <img alt="profile"
                                    src="{{Auth::user()->image}}"
                                    class="rounded-circle img-responsive mt-2" width="200" height="200" />
                                @endif

                                <div class="mt-2">
                                    <input type="text" class="form-control" name="image" id="image"
                                        placeholder="Masukan Link Gambar" value="{{ old('image') }}">
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-3">
                                <label class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Masukan nama pengguna"
                                    value="{{ old('name') }}{{Auth::user()->name}}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Masukan email pengguna" readonly
                                    value="{{ old('email') }}{{Auth::user()->email}}">
                                @if ($errors->has('email'))
                                <span class="text-danger">
                                    <label id="basic-error" class="validation-error-label" for="basic">Email
                                        sudah digunakan</label>
                                </span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control mb-2" name="password_old"
                                    id="password_old" placeholder="Masukan password pengguna" readonly
                                    value="{{ old('password_old') }}{{Auth::user()->password}}">
                                {{-- Collapse Update Password --}}
                                <button type="button" class="btn btn-warning mb-2 text-white" id="password_collapse_edit"
                                    data-toggle="collapse" data-target="#toggle-collapse" id="btn-title-collapse">Update
                                    Password</button>
                                <span class="form-label text-sm text-danger" id="hint_password"></span>
                                <div id="toggle-collapse" class="collapse">
                                    <input type="password" class="form-control mb-2" name="password_check"
                                        id="password_check" placeholder="Masukan password lama">
                                    <div class="input-group">
                                        <input type="password" id="password" name="password"
                                            class="form-control" placeholder="Masukan password baru"
                                            data-parsley-errors-container=".errorspannewpassinput"
                                            data-parsley-minlength="8" data-parsley-uppercase="1"
                                            data-parsley-lowercase="1"
                                            data-parsley-number="1"
                                            data-parsley-special="1">
                                        <div class="input-group-append">
                                            <span id="myeyesbutton" onclick="change()" class="input-group-text">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill"
                                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                    <path fill-rule="evenodd"
                                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2" id="password-generated">
                                        <label class="form-label">Password Length:</label>
                                        <input type="number" class="col-md-2" id="the_length_pass" size=3 maxlength="2"
                                            value="10">
                                        <button type="button" class="btn btn-light" id="generate_password"
                                            title="Generate Password">Generate <i
                                                class="fas fa-sync-alt ml-1"></i></button>
                                    </div>
                                    <span class="errorspannewpassinput"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success submit text-white"><i data-feather="edit" width="16" height="16"></i>
                Simpan</button>
        </form>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $('#generate_password').click(function () {

        let keylist = "123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%^&*"
        let temp = ''
        let length = $('#the_length_pass').val();


        for (i = 0; i < length; i++)
            temp += keylist.charAt(Math.floor(Math.random() * keylist.length))

        $('#password').val(temp);

    });

    //show hide password
    function change() {
        var x = document.getElementById('password').type;
        if (x == 'password') {
            document.getElementById('password').type = 'text';

            document.getElementById('myeyesbutton').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                        <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                        </svg>`;
        } else {
            document.getElementById('password').type = 'password';

            document.getElementById('myeyesbutton').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                        </svg>`;
        }
    }

    //has uppercase
    window.Parsley.addValidator('uppercase', {
      requirementType: 'number',
      validateString: function(value, requirement) {
        var uppercases = value.match(/[A-Z]/g) || [];
        return uppercases.length >= requirement;
      },
      messages: {
        en: 'Your password must contain at least (%s) uppercase letter.'
      }
    });

    //has lowercase
    window.Parsley.addValidator('lowercase', {
      requirementType: 'number',
      validateString: function(value, requirement) {
        var lowecases = value.match(/[a-z]/g) || [];
        return lowecases.length >= requirement;
      },
      messages: {
        en: 'Your password must contain at least (%s) lowercase letter.'
      }
    });

    //has number
    window.Parsley.addValidator('number', {
      requirementType: 'number',
      validateString: function(value, requirement) {
        var numbers = value.match(/[0-9]/g) || [];
        return numbers.length >= requirement;
      },
      messages: {
        en: 'Your password must contain at least (%s) number.'
      }
    });

    //has special char
    window.Parsley.addValidator('special', {
      requirementType: 'number',
      validateString: function(value, requirement) {
        var specials = value.match(/[^a-zA-Z0-9]/g) || [];
        return specials.length >= requirement;
      },
      messages: {
        en: 'Your password must contain at least (%s) special characters.'
      }
    });


</script>
@endsection
