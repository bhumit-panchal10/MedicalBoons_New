<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>Invoice</title>

    <style>
        @page {
            margin: 20px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
            color: #333;
            background: #ffffff;
        }

        .main-box {
            border: 2px solid #2f4774;
            border-radius: 12px;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .header {
            padding: 20px;
        }

        .logo {
            width: 190px;
        }

        .invoice-chip {
            border: 1px solid #d8d8d8;
            padding: 8px 18px;
            border-radius: 30px;
            font-size: 13px;
        }

        .title-bar {
            background: #344d79;
            color: white;
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            letter-spacing: 10px;
            padding: 15px;
        }

        .content {
            padding: 20px;
        }

        .box {
            border: 1px solid #dcdcdc;
            border-radius: 8px;
            padding: 15px;
            height: 135px;
        }

        .box-title {
            font-weight: bold;
            color: #23395d;
            margin-bottom: 12px;
            font-size: 15px;
        }

        .label {
            color: #6c757d;
            width: 140px;
        }

        .value {
            color: #000;
        }

        .space {
            height: 18px;
        }
    </style>

</head>

<body>

    <div class="main-box">

        <table class="header">

            <tr>

                <td width="55%">
                    <img src="{{ public_path('Front/images/logo.jpeg') }}" class="logo">
                </td>

                <td align="right">
                    <span class="invoice-chip">
                        MEDICALBOONS INVOICE
                    </span>
                </td>

            </tr>

        </table>

        <div class="title-bar">
            I N V O I C E
        </div>

        <div class="content">

            <table>

                <tr>

                    <td width="49%" valign="top">

                        <div class="box">

                            <div class="box-title">
                                Invoice Details
                            </div>

                            <table>

                                <tr>
                                    <td class="label">
                                        Invoice No.
                                    </td>

                                    <td class="value">
                                        {{ $CorporateOrder->invoice_no }}
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="space"></td>
                                </tr>

                                <tr>
                                    <td class="label">
                                        Invoice Date
                                    </td>

                                    <td class="value">
                                        {{ date('d-m-Y', strtotime($CorporateOrder->created_at)) }}
                                    </td>
                                </tr>

                            </table>

                        </div>

                    </td>

                    <td width="2%"></td>

                    <td width="49%" valign="top">

                        <div class="box">

                            <div class="box-title">
                                Billing To
                            </div>

                            <table>

                                <tr>

                                    <td class="label">
                                        Customer Name
                                    </td>

                                    <td class="value">
                                        {{ $CorporateOrder->Name }}
                                    </td>

                                </tr>

                                <tr>
                                    <td colspan="2" class="space"></td>
                                </tr>

                                <tr>

                                    <td class="label">
                                        Billing Address
                                    </td>

                                    <td class="value">
                                        {{ $CorporateOrder->address }}
                                    </td>

                                </tr>

                            </table>

                        </div>

                    </td>

                </tr>

            </table>

            <br>
            <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">

                <thead>

                    <tr style="background:#f5f5f5;">

                        <th
                            style="
                padding:12px;
                border:1px solid #e5e5e5;
                text-align:center;
                font-size:15px;
            ">
                            Item & Particular
                        </th>

                        <th
                            style="
                width:180px;
                padding:12px;
                border:1px solid #e5e5e5;
                text-align:right;
                font-size:15px;
            ">
                            Amount (₹)
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td
                            style="
                padding:15px;
                border-bottom:1px solid #e5e5e5;
            ">
                            {{ $CorporateOrder->plan->name }}
                        </td>

                        <td
                            style="
                padding:15px;
                text-align:right;
                border-bottom:1px solid #e5e5e5;
            ">
                            ₹ {{ number_format($CorporateOrder->plan->amount, 2) }}
                        </td>

                    </tr>

                </tbody>

            </table>

            <table width="100%" style="margin-top:8px;">

                <tr>

                    <td align="right">

                        <table width="250">

                            <tr>

                                <td
                                    style="
padding:12px;
font-weight:bold;
font-size:18px;
border-top:2px solid #2f4774;
">

                                    Total

                                </td>

                                <td align="right"
                                    style="
padding:12px;
font-weight:bold;
font-size:18px;
border-top:2px solid #2f4774;
">

                                    ₹ {{ number_format($CorporateOrder->plan->amount, 2) }}

                                </td>

                            </tr>

                        </table>

                    </td>

                </tr>

            </table>

            <p style="
margin-top:30px;
font-size:13px;
color:#777;
">

                This is a system generated invoice, signature is not required.

            </p>

            <table width="100%" style="
border:1px solid #d8d8d8;
border-radius:8px;
margin-top:15px;
">

                <tr>

                    <td style="padding:15px;">

                        <b>REGISTERED OFFICE ADDRESS</b>

                        —

                        C-2, Rajkamal Plaza-A,

                        Nr C U Shah College,

                        Income Tax,

                        Ashram Road,

                        Ahmedabad,

                        Gujarat,

                        India.

                    </td>

                </tr>

            </table>

        </div>

        <div style="
text-align:center;
padding:18px;
background:#f8f8f8;
font-size:13px;
color:#888;
">

            © {{ date('Y') }} MedicalBoons. All rights reserved.

        </div>

    </div>

</body>

</html>
