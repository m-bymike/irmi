@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Calendar Integration</div>
                    <div class="panel-body">
                        <div class="input-group">
                            <span class="input-group-addon" id="ical-link">URL</span>
                            <input type="url"
                                   class="form-control"
                                   value="{{ action('ICalController@download', ['token' => $user->calendar_token]) }}"
                                   readonly
                                   name="ical-link"
                                   aria-describedby="ical-link"
                            >
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Passport</div>

                    <div class="panel-body">
                        <passport-clients></passport-clients>
                        <passport-authorized-clients></passport-authorized-clients>
                        <passport-personal-access-tokens></passport-personal-access-tokens>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function () {
      $('input[name=ical-link]').click(function () {
        $(this).select();
      })
    })
</script>
@endpush

