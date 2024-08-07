@props(['title'=>'vedicmath','levelTitle'=>'','difficultyTitle'=>''])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title.' '.$levelTitle.' '.$difficultyTitle }}</title>
    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }

        * {
            font-family: "Sarabun", sans-serif;
            font-style: normal;
            font-size: 15px;
        }

        .dash {
            position: relative;
        }

        .dash::before {
            position: absolute;
            content: '/';
            color: #EF4444;
            /* Red-500 */
            font-size: 10px;
            font-weight: 600;
            /* Semibold */
            top: -9px;
            left: 4px;
        }

        /* .dot {
            position: relative;
        }

        .dot::after {
            position: absolute;
            content: '.';
            color: #EF4444;
            /* Red-500 */
            font-weight: 600;
            /* Semibold */
            top: -16px;
            left: 2.5px;
        } */

        .bar {
            position: relative;
        }

        .bar::after {
            position: absolute;
            content: '-';
            font-size: 24px;
            color: #EF4444;
            top: -20px;
            left: 0;
        }

        .bar-sub {
            position: relative;
        }

        .bar-sub::after {
            position: absolute;
            content: '-';
            font-size: 20px;
            color: #EF4444;
            top: -9px;
            left: -1px;
        }

        .bar-text {
            position: relative;
        }

        .bar-text::after {
            position: absolute;
            content: '-';
            font-size: 20px;
            color: #EF4444;
            top: -9px;
            left: 0px;
        }
        .front-plus{
            position: relative;
            font-size: 12px;
        }
        .front-plus::before{
            position:absolute;
            content:'+';
            color:red;
            left:-7px;
            top:-2px;
            font-size: 12px;
        }

    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    {{ $slot }}

</body>

</html>
