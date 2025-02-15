<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(90deg, rgba(255, 158, 0, 1) 26%, rgba(251, 179, 61, 1) 100%);
            font-family: Arial, sans-serif;
            color: #fff;
            text-align: center;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        img {
            max-width: 300px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 48px;
            margin: 0;
        }

        p {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="https://portal.ds.ppu.edu/assets/images/logo/logo_ds2.png" alt="Logo">
        <h1>صفحة غير متوفرة </h1>
        <p>يبدو انك لا تمتلك الوصول الى هذه الصفحة او اتبعت رابط منتهي الصلاحية

        </p>

        <a class="btn btn-primary btn-lg" href="{{ route('home') }}">العودة الى الرئيسية</a>




    </div>
</body>

</html>
