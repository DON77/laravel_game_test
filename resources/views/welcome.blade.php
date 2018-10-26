<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="css/app.css" rel="stylesheet" type="text/css">
        <script src="js/app.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: space-around;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            #jsoneditor {
                width: 400px; 
                height: 400px;
            }
            .save {
                text-align: center;
                margin-top: 10px;
                display: none;
            }
            .list {
                cursor: pointer;
                border-color: black;
            }
            .error {
                text-align: center;
                font-size: 24px;
                color: red; 
            }
        </style>
    </head>
    <body>
        @if($errors->any())
            <h4 class="error">{{$errors->first()}}</h4>
        @endif
        <div class="flex-center position-ref full-height">
            <ul class="list-group">
                @foreach($games as $game)
                    <li class="list list-group-item" data-game='{{ $game->game }}'>{{ $game->id }}</li>
                @endforeach
            </ul>
            <div>
                <div id="jsoneditor"></div>
                <form action="/save" method='post' class="save">
                    {{ csrf_field() }}
                    <input type="hidden" name='id' value="" id='game_id' />
                    <input type="hidden" name='game' class="game_val" value="" id='game' />
                    <input type="submit" value="Save" class="btn btn-success" />
                </form>
            </div>
        </div>
        <script>
            $('.list').click(function () {
                $('#jsoneditor').empty();
                let game = JSON.parse($(this).attr('data-game'));
                $('.save').find('#game_id').val($(this).html());
                showEditor(game);
                $('.save').show();
            })
            // create the editor
            function showEditor(game) {
                var container = document.getElementById("jsoneditor");
                var options = {onChangeJSON: handleChange};
                var editor = new JSONEditor(container, options);
    
                editor.set(game);
    
                // get json
                var json = editor.get();
                $('.save').find('.game_val').val(JSON.stringify(json));
                function handleChange(json) {
                    $('.save').find('.game_val').val(JSON.stringify(json));
                }
            }
        </script>
    </body>
</html>
