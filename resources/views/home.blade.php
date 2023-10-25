<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body>

        @include('navbar')

        <div class="p-6">
            <div class="flex gap-4">
                @if(count($estates) > 0)
                    @foreach ($estates as $estate)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">{{ $estate->title }}</h2>
                                    <p class="card-text">{{ $estate->created_at }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @else
                    <p>No estates yet added.</p>
                @endif
            </div>
        </div>

    </body>
</html>
