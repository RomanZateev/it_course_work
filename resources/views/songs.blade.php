@extends('layouts.app')

@section('content')

<div class="container">
    @if (auth()->check())
        @if (auth()->user()->isAdmin())
            <div class="row">
                <div class="col">
                    <a class="btn btn-success text-white btn-lg mb-4" href="{{URL::route('songs_create')}}">Добавить композицию</a>
                </div>
            </div>
        @endif
    @endif
    <div class="row">
        <div class="col-2">
            <div class="h4 font-weight-bold heading">№</div>
        </div>
        <div class="col-5">
            <div class="h4 font-weight-bold heading">Треки</div>
        </div>
        <div class="col-5">
            <div class="h4 font-weight-bold heading">Исполнители</div>
        </div>
    </div>
    @if ($songs ?? '')
        @foreach ($songs as $song)
            <a class="h4 font-weight-light text-secondary" href="{{ URL::route('song', $song->id) }}">
                <div class="row song-hover border-bottom rounded track-line">
                    <div class="col-2 pt-3 pb-2">
                        <div class="h4 font-weight-light text-secondary">
                            {{ ($songs ->currentpage()-1) * $songs ->perpage() + $loop->index + 1 }}
                        </div>
                    </div>
                    <div class="col-5 pt-2 pb-2">
                        <img src="{{$song->image}}" alt="{{$song->name}}" width="50" height="50">
                        {{$song->name}}
                    </div>
                    <div class="col-5 pt-3 pb-2">
                        <div class="h4 font-weight-light text-secondary">
                            {{$song->artists()->pluck('name')->implode(', ')}}
                        </div>
                    </div>
                </div>
            </a>
        @endforeach

        <div class="row pt-2 justify-content-md-center">
            {{ $songs->links() }}
        </div>
    @endif

    @if (!empty($message))
        <div class="row top-buffer">
            <div class="col">
                <div class="h4 font-weight-light text-secondary">
                    {{ $message }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection