<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xoş gəldiniz!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            background: #007BFF;
            color: white;
            padding: 15px;
            border-radius: 8px 8px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        .content h2 {
            color: #333;
            font-size: 22px;
        }

        .content p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background: #007BFF;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background: #0056b3;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            padding: 15px;
            border-top: 1px solid #ddd;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Xoş gəldiniz!</h1>
    </div>

    <div class="content">
        <h2>Salam, <?php echo e($name); ?>! 🎉</h2>
        <p>Sizin qeydiyyatınız uğurla tamamlandı. Artıq hesabınız aktivdir və siz sistemdən istifadə edə bilərsiniz.</p>

        <p>Daha çox funksionallıqdan istifadə etmək üçün hesabınıza daxil olun.</p>

        <a href="<?php echo e(route('login')); ?>" class="btn">Hesaba Daxil Ol</a>
    </div>

    <div class="footer">
        <p>&copy; <?php echo e(date('Y')); ?> Layihə İdarəetmə Sistemi. Bütün hüquqlar qorunur.</p>
    </div>
</div>

</body>
</html>
<?php /**PATH C:\Users\aygun\PhpstormProjects\TrelloApp\resources\views/emails/notifyRegister.blade.php ENDPATH**/ ?>