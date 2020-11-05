@section('js')
    <script type="text/javascript">
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function(){
                // do ajax submit or just classic form submit
              //  alert("fake subminting")
                return false
            })
        })


var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('submit').disabled = false;
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
  } else {
    document.getElementById('submit').disabled = true;
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';
  }
}
    </script>
@stop

@extends('layouts.master')

@section('content')
<div class="box">
<div class="box-header">
<h3 class="box-title">Edit Akun</h3>
</div>
<div class="box-body">
<div class="container col-md-6">
<form action="{{ route('user.update', $data->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('put') }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label">Name</label>
            
                <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
            
        </div>

        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
            <label for="username" class="control-label">Username</label>
            
                <input id="username" type="text" class="form-control" name="username" value="{{ $data->username }}" required readonly="">
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
            
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="control-label">E-Mail Address</label>
            
                <input id="email" type="email"  class="form-control" name="email" value="{{ $data->email }}" required readonly="">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
        </div>

        <div class="form-group">
            <label for="email" class=" control-label">Gambar</label>
            
                <img class="product" width="200" height="200" @if($data->gambar) src="{{ asset('images/user/'.$data->gambar) }}" @endif />
              
                <input type="file" class="uploads form-control" style="margin-top: 20px;" name="gambar">
            
        </div>

        @if(Auth::user()->level == 'admin')
        <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
        <label for="level" class="control-label">Level</label>
            <select class="form-control" name="level" required="">
                <option value="admin" @if($data->level == 'admin') selected @endif>Admin</option>
                    <option value="perencanaan" @if($data->level == 'perencanaan') selected @endif>Perencanaan</option>
                    <option value="konstruksi" @if($data->level == 'konstruksi') selected @endif>Konstruksi</option>
            </select>           
        </div>             
        @endif
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="control-label">Password</label>     
                <input id="password" type="password" class="form-control" onkeyup='check();' name="password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
        </div>

        <div class="form-group">
            <label for="password-confirm" class="col-lg-4 control-label">Confirm Password</label>
                <input id="confirm_password" type="password" onkeyup="check()" class="form-control" name="password_confirmation">
                    <span id='message'></span>
        </div>

        <button type="submit" class="btn btn-primary" id="submit"> Update</button>
        <a href="{{route('user.index')}}" class="btn btn-light pull-right">Back</a>
</form>
</div>
</div>
</div>
@endsection