<!DOCTYPE html>
<html>
    <head>
        <title>404 | Not Found</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">D'oh! 202 + 202 = 404</div>
            </div>
            <br>
            The page you are looking for at <b>"{{ URL::full() }}"</b> could not be found.<br>
            You can try to go <a href="{{ Url::previous() }}">back</a>, close the tab or check the math.
        </div>
    </body>
</html>
