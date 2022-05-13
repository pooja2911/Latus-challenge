<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Code Challenge</title>
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: sans-serif;
                height: 100vh;
                margin: 50px;
            }

            .full-height {
                height: 100vh;
            }

            .result {
            }
            table, td, th {  
                border: 1px solid #ddd;
                text-align: left;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <div class="full-height">
            <div class="result">
                Your Search Term Was: <b>{{$searchTerm}}</b>                
            </div>            
            <h3>Album</h3>
            <hr>
            <table>
                @foreach ($album->albums->items as $result)
                <tr>
                    <td>{{$result->name}}</td>
                    <td><img src="{{$result->images[0]->url}}" style="width: 80px;height: 80px;"></td>
                </tr>
                @endforeach
            </table>
            <h3>Artist</h3>
            <hr>
            <table>
                @foreach ($artist->artists->items as $result1)
                <tr>
                    <td>{{$result1->name}}</td>
                    <td>
                        @if(isset($result1->images[0]->url) && $result1->images[0]->url!='')
                        <img src="{{$result1->images[0]->url}}" style="width: 80px;height: 80px;">
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
            <h3>Tracks</h3>
            <hr>
            <table>
                @foreach ($track->tracks->items as $result1)
                <tr>
                    <td>{{$result1->name}}</td>  
                    <td>
                        @if(isset($result1->album->images[0]->url) && $result1->album->images[0]->url!='')
                        <img src="{{$result1->album->images[0]->url}}" style="width: 80px;height: 80px;">
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </body>
</html>
