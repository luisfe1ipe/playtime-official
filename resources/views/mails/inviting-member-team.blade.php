<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <style>
        p {
            margin: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 32px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            color: #a855f7;
            margin-bottom: 20px;
        }


        .email-body {
            text-align: center;
        }

        .email-body h2 {
            font-size: 20px;
            color: #333;
        }

        .email-body p {
            font-size: 16px;
            color: #666;
            line-height: 1.5;
        }

        .email-buttons {
            margin-top: 30px;
        }

        .button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 0 10px;
        }

        .button.accept {
            background-color: #a855f7;
        }

        .button.decline {
            background-color: #f43f5e;
        }

        .email-footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #999;
        }

        .email-footer p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div style="color: #FFFFFF" class="email-container">
        <div class="email-header">
            <a href="" style="text-decoration: none">
                <h1 style="color:#a855f7">{{getenv('APP_NAME')}}</h1>
            </a>
        </div>
        <div class="email-body">
            <h2>Convite para Participar do Time</h2>
            <p>Olá, você foi convidado por <a style="color: #a855f7; text-decoration: underline"
                    href="{{route('profile', ['nick' => $teamLeaderNick])}}"><strong>{{$teamLeaderNick}}</strong></a> para se juntar ao time <a
                    style="color: #a855f7; text-decoration: underline" href="{{route('my-teams.show', ['slug' => $teamSlug])}}"><strong>{{$teamName}}</strong></a>.</p>
            <p>Para aceitar ou recusar o convite, clique em um dos botões abaixo:</p>
            <div class="email-buttons">
                <a href="URL_PARA_RECUSAR" style="color: #FFFFFF" class="button decline">Recusar</a>
                <a href="URL_PARA_ACEITAR" style="color: #FFFFFF" class="button accept">Aceitar</a>
            </div>
        </div>
        <div class="email-footer">
            <p>© {{date('Y')}} {{getenv('APP_NAME')}}. Todos os direitos reservados.</p>
            <p>Você está recebendo este e-mail porque foi convidado para participar de um time no {{getenv('APP_NAME')}}.</p>
        </div>
    </div>
</body>

</html>
