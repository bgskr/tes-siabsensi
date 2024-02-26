<!DOCTYPE html>
<html>

<head>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 0;
            }

            body {
                margin: 1.6cm;
            }
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
        }

        .content {
            text-align: justify;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    @yield('content-pdf')
</body>

</html>
