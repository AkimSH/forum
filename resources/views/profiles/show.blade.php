@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h1>
                        {{ $profileUser->name }}
                        <small>registered {{ $profileUser->created_at->diffForHumans() }}</small>
                    </h1>
                </div>
                <hr>
                <br>
                <br>

                @foreach($activities as $date => $activity)
                    <h3 class="page-item">{{ $date }}</h3>
                    <hr>
                    @foreach($activity as $record)
                        @include("profiles.activities.{$record->type}", ['activity' => $record]) {{-- rewriting so activity wouldd be the same variable name in other views--}}
                    @endforeach
                @endforeach
                {{--{{$threads->links()}}--}}
            </div>
        </div>
    </div>
@endsection

