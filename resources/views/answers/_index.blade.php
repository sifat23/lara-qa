<div class="row justify-content-center mt-2">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . " " . str_plural('Answer', $answersCount) }}</h2>
                </div>
                <hr>
                @include ('layouts._messages')
                @foreach ($answers as $answer)
                <div class="media">
                    <div class="d-flex flex-column vote-controls">
                        <a title="This answer is useful" class="vote-up">
                            <i class="fas fa-caret-up fa-3x"></i>
                        </a>
                        <span class="votes-count">1223</span>
                        <a title="this answer is not useful" class="vote-down off">
                            <i class="fas fa-caret-down fa-3x"></i>
                        </a>
                        @can ('accept', $answer)
                            <a title="mark this answer is best answer" class="mt-2 {{ $answer->status }}"
                                onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();">
                                <i class="fas fa-check fa-2x"></i>
                            </a>
                            <form id="accept-answer-{{ $answer->id }}" action="{{ route('answers.accept', $answer->id) }}" method="post" style="dislpay: none;">
                                @csrf
                            </form>
                        @else
                            @if ($answer->is_best)
                                <a title="The question owner accept this answer as best answer" class="mt-2 {{ $answer->status }}">
                                    <i class="fas fa-check fa-2x"></i>
                                </a>
                            @endif
                        @endcan
                    </div>
                    <div class="media-body">
                        {!! $answer->body_html !!}
                        <div class="row">
                            <div class="col-4">
                                <div class="ml-auto">
                                    @can ('update', $answer)
                                        <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                    @endcan

                                    @can ('delete', $answer)
                                        <form class="form-delete" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                            <div class="col-4">

                            </div>
                            <div class="col-4">
                                <span class="text-muted">Answerd {{ $answer->created_date }}</span>
                                <div class="media mt-2">
                                    <a href="{{ $answer->user->url }}" class="ps-2">
                                        <img src="{{ $answer->user->avater }}" alt="">
                                    </a>
                                    <div class="media-body ml-1 mt-1">
                                        <a href="{{ $answer->user->url }}">
                                            {{ $answer->user->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
