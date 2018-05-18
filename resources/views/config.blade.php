@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <h1>{{ __('messages.configuration') }}</h1>
    </div>


    <div class="card">
      <div class="card-header">
        {{ __('messages.changePass') }}
      </div>
      <div class="card-body">
        <form action="{{ route('cambiar.pass') }}" method="post">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="oldPass">{{ __('messages.oldlPass') }}</label>
            <input type="password" name="oldPass" class="form-control">
          </div>

          <div class="form-group">
            <label for="newPass1">{{ __('messages.newPass') }}</label>
            <input type="password" name="newPass1" class="form-control">
          </div>

          <div class="form-group">
            <label for="newPass2">{{ __('messages.confirmPass') }}</label>
            <input type="password" name="newPass2" class="form-control">
          </div>

          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="{{ __('messages.save') }}">
          </div>

        </form>

      </div>
    </div>
    {{--
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h5>{{ __('messages.changePass') }}</h5>
      </div>
      <div class="panel-body">
        <form action="{{ route('cambiar.pass') }}" method="post">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="oldPass">{{ __('messages.oldlPass') }}</label>
            <input type="password" name="oldPass" class="form-control">
          </div>

          <div class="form-group">
            <label for="newPass1">{{ __('messages.newPass') }}</label>
            <input type="password" name="newPass1" class="form-control">
          </div>

          <div class="form-group">
            <label for="newPass2">{{ __('messages.confirmPass') }}</label>
            <input type="password" name="newPass2" class="form-control">
          </div>

          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="{{ __('messages.save') }}">
          </div>

        </form>

      </div>
    </div>
    --}}
  </div>
@endsection
