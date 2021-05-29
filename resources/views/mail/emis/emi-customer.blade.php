<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        table,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
        
        td {
            font-weight: 600;
        }
        
        h4 {
            line-height: 2px;
        }
        
        hr {
            height: 5px solid black;
        }
        
        li {
            font-size: 20px;
            line-height: 25px;
            font-weight: 600;
        }
        
        table {
            margin: 0 auto;
        }
        
        body {
            padding: 30px 80px 30px 80px;
        }
        
        @media only screen and (min-width: 375px and max-width: 500px) {
            body {
                padding: 110px 10px 110px 10px !important;
            }
            h4 {
                line-height: 10px;
            }
            td {
                font-size: 33px;
            }
            h3 {
                margin: 10px 0px !important;
            }
        }
    </style>
</head>

<body>
    <p style="margin:0 auto; text-align:center;">

        <img style="max-width: 100%; " class="img-fluid" src="{{ asset('/web/images/letter-headtop.png') }}" alt="Fatafat Sewa">
    </p>
    <br>
    <h4>To</h4>
    <h4>{{ str_replace('  ',' ', $data['emiData']['first_name'].' '.$data['emiData']['middle_name'].' '.$data['emiData']['last_name']) }}</h4>

    <p>Dear Concern,</p>
    <p> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;This is to inform you this below illustration is for the finance amount for {{ $data['product']->products_name }}</p>
    <table>
        <tr>
            <td>Quotation for</td>
            <td>{{  $data['product']->products_name  }}</td>
        </tr>
        <tr>
            <td>Price Of Products</td>
            <td>NPR {{  $data['product']->products_price  }}</td>
        </tr>
        <tr>
            <td>Down Payments </td>
            <td>NPR {{ $data['emiData']['down_payment'] }}</td>
        </tr>
        <tr>
            <td>QFinance Amount</td>
            <td>NPR {{ $data['emiData']['finance_amount'] }}</td>
        </tr>
        <tr>
            <td>Duration ( in Month )</td>
            <td>{{ $data['emiData']['emi_mode'] }}</td>
        </tr>
        <tr>
            <td>EMI Per Month</td>
            <td>NPR {{ $data['emiData']['emi_per_month'] }}</td>
        </tr>
    </table>
    <br>
    <h3>Customer Details:</h3>
    <h3>
        <tr>Full Name:</tr>
        <td>{{ $data['emiData']['first_name'].' '.$data['emiData']['middle_name'].' '.$data['emiData']['last_name'] }}</td>
    </h3>
    <h3>
        <tr>Contact:</tr>
        <td>{{ $data['emiData']['contact'] }}</td> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
        <tr>Email:</tr>
        <td>{{ $data['emiData']['email'] }}</td>
    </h3>
    <h3>
        <tr>Address:</tr>
        <td>{{ $data['emiData']['address'] }}</td>
    </h3>
    <br>
    <br>
    <h3>Your Truly,</h3>

    <hr>
    <h3 style="text-align:center;">Terms and Condition</h3>
    <ul>
        <li>The Quotation form is valid up to 7 days for the issued date.</li>
        <li>Customer shall not pay more than MRP amount.</li>
        <li>EMI amount is the amount after dividing the finance amount by the duration.</li>
    </ul>
    <br>
    <p style="margin:0 auto; text-align:center;">

        <img style="max-width: 100%; " class="img-fluid" src="{{ asset('/web/images/letter-headbottom.png') }}" alt="Fatafat Sewa">
    </p>
</body>

</html>