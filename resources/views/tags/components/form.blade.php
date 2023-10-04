<form action="{{ $action }}" method="{{ $formMethod ?? 'POST' }}" novalidate>
    <div class="form-group">
        <label for="name">
            Tytuł zadania
        </label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="np. ważne/do szkoły/na później" value="{{ $nameValue }}">
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">
       {{ $submitBtnText }}
    </button>

    @method($method ?? 'POST')
    @csrf

</form>