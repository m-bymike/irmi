@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Upcoming reservations</div>

                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Callsign</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->getCallsign() }}</td>
                                <td>{{ $reservation->getStart()->format('Y-m-d H:i T') }}</td>
                                <td>{{ $reservation->getEnd()->format('Y-m-d H:i T') }}</td>
                                <td>{{ $reservation->getEnd()->diffForHumans($reservation->getStart(), true)  }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
