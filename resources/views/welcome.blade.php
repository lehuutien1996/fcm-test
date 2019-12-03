<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <link rel="stylesheet" href="{{ asset('bundled/app.css') }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <style>
            * {
                box-sizing: border-box;
            }
            html, body {
                font-family: Nunito;
            }
            #messages {
                height: 400px;
                overflow-x: hidden;
                overflow-y: auto;
                border: 1px solid #ecf0f1;
                padding: 6px;
            }
            .message__wrapper {
                margin: 4px 0;
            }
            .message-gap {
                height: inherit;
            }
            .message__wrapper .message__title,
            .message__wrapper .message__content {
                display: block;
            }
            .message__wrapper .message__title {
                font-size: 12px;
                font-weight: 600;
                padding: 0 12px;
            }
            .message__wrapper .message__content {
                font-weight: 400;
                border-color: #ecf0f1;
                background-color: #efefef;
                padding: 6px 12px;
            }
            .form__name {
                margin: 10px 0;
            }
            .form__name label {
                font-size: 13px;
                font-weight: 600;
            }
            .form__name input {
                width: 100%;
                padding: 4px 8px;
            }
            .input-box {
                display: flex;
                margin: 12px 0;
            }
            .input-box .textarea {
                flex: 1;
            }
            .input-box .textarea textarea {
                width: 100%;
            }
            .input-box .send-button {
                padding-left: 12px;
            }
            .input-box .send-button button {
                padding: 8px 12px;
            }
        </style>
    </head>
    <body>
        <div class="form__name">
            <label for="name">Tên: </label>
            <input type="text" name="name" id="name" value="User #{{ rand(1, 100) }}">
        </div>
        <div id="messages">
            <div class="message-gap"></div>
        </div>
        <div class="input-box">
            <div class="textarea">
                <textarea name="message" id="message" rows="2"></textarea>
            </div>
            <div class="send-button">
                <button id="send">Send</button>
            </div>
        </div>

        <script>
            window.isWindowFocused = true;
            window.onfocus = () => window.isWindowFocused = true;
            window.onblur  = () => window.isWindowFocused = false;
        </script>

        {{--<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>--}}
        {{--<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-messaging.js"></script>--}}
        <script src="{{ asset('bundled/app.js') }}"></script>
    </body>
</html>
