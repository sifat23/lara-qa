@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h3>{{ $question->title }}</h3>
                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to All Question</a>
                            </div>
                        </div>
                    </div>

                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This question is useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}" onclick="event.preventDefault(); document.getElementById('up-vote-question-{{ $question->id }}').submit();">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <form id="up-vote-question-{{ $question->id }}" action="/questions/{{ $question->id }}/vote" method="post" style="dislpay: none;">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                            <span class="votes-count">{{ questions->votes_count }}</span>
                            <a title="this question is not useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}" onclick="event.preventDefault(); document.getElementById('down-vote-question-{{ $question->id }}').submit();">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <form id="down-vote-question-{{ $question->id }}" action="/questions/{{ $question->id }}/vote" method="post" style="dislpay: none;">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>
                            <a onclick="event.preventDefault(); document.getElementById('favorite_question-{{ $question->id }}').submit();" title="Click to mark as favorite question (Click again to undo)" class="favorite mt-2 {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' : '') }}">
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorites-count">{{ $question->favorites_count}}</span>
                            </a>
                            <form id="favorite_question-{{ $question->id }}" action="/questions/{{ $question->id }}/favorites" method="post" style="dislpay: none;">
                                @csrf
                                @if ($question->is_favorited)
                                    @method ('DELETE')
                                @endif
                            </form>
                        </div>
                        <div class="media-body">
                            {!! $question->body_html !!}
                            <div class="float-right">
                                <span class="text-muted">Answerd {{ $question->created_date }}</span>
                                <div class="media mt-2">
                                    <a href="{{ $question->user->url }}" class="ps-2">
                                        <img src="{{ $question->user->avater }}" alt="">
                                    </a>
                                    <div class="media-body ml-1 mt-1">
                                        <a href="{{ $question->user->url }}">
                                            {{ $question->user->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include ('answers._index', [
        'answers' => $question->answers,
        'answersCount' => $question->answers_count,
    ])
    @include ('answers._create')
</div>
@endsection
