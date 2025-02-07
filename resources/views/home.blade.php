<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Url Shortener</title>

    <!-- Overpass google font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- icon link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <h1>URL Shortener</h1>
    <div class='container'>
        <form class="form-input" action="{{ route('shortener.store') }}" method="POST">
            @csrf
            <input type="text" name='url' placeholder="Place or paste your url here.."
                value="{{ old('url') }}" autofocus autocomplete="off">
            <button type="submit">Short</button>
        </form>
        @error('error')
            <div class="flash-error">
                <span>
                    <i class="bx bxs-error-alt flash-error-icon"></i> {{ $message }}
                </span>
            </div>
        @enderror

        <div class="data-container">
            @if ($urls->isNotEmpty())
                @foreach ($urls->all() as $url)
                    <div class="url">
                        <span class='title'>
                            <div><i class='bx bx-info-circle'></i>Shorted url</div>
                            <div><i class='bx bx-pointer'>{{ $url->click }}</i></div>
                        </span>
                        <div class="shorted-url">
                            <a href="{{ route('shortener.show', $url->short_url) }}" target="_blank"
                                rel="noopener noreferrer"
                                class='shorted-url-text'>urlshortener.test/{{ $url->short_url }}</a>
                            <form action="{{ route('shortener.destroy', $url->short_url) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete-btn"><i class="bx bx-trash"></i></button>
                            </form>
                        </div>
                        <span class='full-url'>{{ $url->full_url }}</span>
                    </div>
                @endforeach
            @else
                <div class="list-empty">
                    There's no short url created...
                </div>
            @endif
        </div>
    </div>

</body>

</html>
