<div class="row justify-content-center mt-2">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>Your Answer</h2>
                </div>
                <hr>
                <form class="" action="{{ route('questions.answers.store', $question->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea name="body" rows="4" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"></textarea>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('body') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-outline-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
