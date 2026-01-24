<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .field {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }
        .value {
            color: #333;
            padding: 10px;
            background-color: #fafafa;
            border-left: 3px solid #007bff;
        }
        .footer {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="margin: 0;">Новая заявка со страницы контактов</h2>
        </div>

        <div class="field">
            <div class="label">Имя:</div>
            <div class="value">{{ $name }}</div>
        </div>

        <div class="field">
            <div class="label">Телефон:</div>
            <div class="value">{{ $phone }}</div>
        </div>

        <div class="field">
            <div class="label">Email:</div>
            <div class="value">{{ $email }}</div>
        </div>

        <div class="field">
            <div class="label">Сообщение:</div>
            <div class="value">{{ $message }}</div>
        </div>

        <div class="field">
            <div class="label">Дата и время заявки:</div>
            <div class="value">{{ $created_at->format('d.m.Y H:i:s') }}</div>
        </div>

        <div class="footer">
            <p>Это автоматическое письмо. Просьба не отвечать на этот адрес.</p>
            <p>&copy; 2xGroupp, {{ date('Y') }}</p>
        </div>
    </div>
</body>
</html>