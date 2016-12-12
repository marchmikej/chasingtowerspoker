@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Update Password</div>

                <div class="panel-body">
                    <form class="form" action="updatepassword" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input class="form-control" name="current_password" type="password" id="current_password">
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input class="form-control" name="password" type="password" id="password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input class="form-control" name="password_confirmation" type="password" id="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
