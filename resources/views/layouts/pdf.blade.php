<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <title>@yield('title')</title>
    <style>
         @page { size: 510pt 780pt; margin-top: 10px; margin-bottom: 10px; margin-left: 15px; margin-right: 15px;  }
        @page {
            size: A4;
            }

        @page :left {
        margin-left: 1cm;
        }

        @page :right {
        margin-left: 1cm;
        }

        body, #wrapper, #content {
            font-family:Arial,Helvetica Neue,Helvetica,sans-serif;
            font-size: 8px;
        }
        .page-break {
            page-break-after: always;
        }
        table{
            border-collapse: collapse;
            border-spacing: 0;
            font-family:Arial,Helvetica Neue,Helvetica,sans-serif;
        }
        table tr{
            font-family:Arial,Helvetica Neue,Helvetica,sans-serif;
        }
        table td{
            font-family:Arial,Helvetica Neue,Helvetica,sans-serif;
        }
        a:link, a:visited {
            font-family:Arial,Helvetica Neue,Helvetica,sans-serif;
        }
        p {
            font-family:Arial,Helvetica Neue,Helvetica,sans-serif;
        }
        .page-number:before {
            content: counter(page);
        }
        hr {
            border: none;
            height: 1px;
            /* Set the hr color */
            color: #333; /* old IE */
            background-color: #333; /* Modern Browsers */
        }
        .document-type {
            font-size: 16px;
        }
        @yield('style')
    </style>
</head><body><br>
<?php
$t=0;
$total=0;
$vat=0;
$sub=0;
?>
<script type="text/php">
     $text = 'Page: {PAGE_NUM} / {PAGE_COUNT}';
</script>
@yield('content')
</body>
</html>
