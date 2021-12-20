@extends('layouts.app')

@section('content')

<div class="container">
    <span>Here is music - </span>
    <div class="row">

        <audio controls style="width: 100%;">
            <source src="test.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </div>
</div>
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="card-body">--}}
{{--            @if (session('status'))--}}
{{--                <div class="alert alert-success" role="alert">--}}
{{--                    {{ session('status') }}--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            <table class="table table-dark">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>First name</th>--}}
{{--                    <th>Last name</th>--}}
{{--                    <th>Order id</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--            @forelse($clients as $client)--}}
{{--                <tr>--}}
{{--                    <td>{{ $client->first_name }}</td>--}}
{{--                    <td>{{ $client->last_name }}</td>--}}
{{--                    <td>{{ $client->shop_id }}</td>--}}
{{--                </tr>--}}
{{--            @empty--}}
{{--                <tr><td colspan="3">No client found</td></tr>--}}
{{--            @endforelse--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--                {{ $clients->links('pagination::bootstrap-4') }}--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</div>--}}

@endsection
