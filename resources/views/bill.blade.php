<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Bill Reciept in Laravel</title>
    <style>
    .result {
        color: red;
    }

    td {
        text-align: center;
    }
    </style>
</head>

<body>
    <section class="mt-3">
        <div class="container">
            <h4 class="text-center" style="color:green"> Ravindu Foods </h4>
            <div class="row">
                <div class="col-md-7  mt-4" id="Bill" style="background-color:#f5f5f5;">

                    <div class="p-4">
                        <div class="text-center">
                            <h4>Receipt</h4>
                        </div>
                        <span class="mt-4"> Time : </span><span class="mt-4" id="time"></span>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 ">
                                <span id="day"></span> : <span id="year"></span>
                            </div>
                            @foreach($sub_totals as $sub_total)
                            <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                <p>Order No:{{$sub_total->id}}</p>
                            </div>
                            @endforeach
                        </div>
                        <div class="row">
                            </span>
                            <table id="receipt_bill" class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="new">

                                </tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->item_name}}</td>
                                    <td>{{$order->quantity}}</td>
                                    <td>{{$order->price}}</td>
                                </tr>
                                @endforeach
                                @foreach($sub_totals as $sub_total)
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td class="text-right text-dark">
                                        <h5><strong>Sub Total: Rs. {{$sub_total->subtotal}} </strong></h5>
                                    </td>
                                    <td class="text-center text-danger">
                                        <h5 id="totalPayment"><strong> </strong></h5>

                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
            <button onclick="printBill()">Print</button>
    </section>
</body>

</html>
<script>
$(document).ready(function() {

    // Code for year 

    var currentdate = new Date();
    var datetime = currentdate.getDate() + "/" +
        (currentdate.getMonth() + 1) + "/" +
        currentdate.getFullYear();
    $('#year').text(datetime);



    // Code for extract Weekday     
    function myFunction() {
        var d = new Date();
        var weekday = new Array(7);
        weekday[0] = "Sunday";
        weekday[1] = "Monday";
        weekday[2] = "Tuesday";
        weekday[3] = "Wednesday";
        weekday[4] = "Thursday";
        weekday[5] = "Friday";
        weekday[6] = "Saturday";

        var day = weekday[d.getDay()];
        return day;
    }
    var day = myFunction();
    $('#day').text(day);
});
</script>
<script>
window.onload = displayClock();

function displayClock() {
    var time = new Date().toLocaleTimeString();
    document.getElementById("time").innerHTML = time;
    setTimeout(displayClock, 1000);
}
</script>

<script>
    function printBill() {
        var divContents = document.getElementById("Bill").innerHTML;
        var a = window.open('', '', '');
        a.document.write('<html>');
        a.document.write('<body>');
        a.document.write('<div class="p-4">');
        a.document.write('<div class="text-center">');
        a.document.write('<h4>Receipt</h4>');
        a.document.write('</div>');
        a.document.write('<span class="mt-4"> Time : </span><span class="mt-4" id="time"></span>');
        a.document.write('<div class="row">');
        a.document.write('<div class="col-xs-6 col-sm-6 col-md-6 ">');
        a.document.write('<span id="day"></span> : <span id="year"></span>');
        a.document.write('</div>');
        a.document.write('@foreach($sub_totals as $sub_total)');
        a.document.write('<div class="col-xs-6 col-sm-6 col-md-6 text-right">');
        a.document.write('<p>Order No:{{$sub_total->id}}</p>');
        a.document.write('</div>');
        a.document.write('@endforeach');
        a.document.write('</div>');
        a.document.write('<div class="row">');
        a.document.write('</span>');
        a.document.write('<table id="receipt_bill" style="text-align: center" class="table">');
        a.document.write('<thead>');
        a.document.write('<tr>');
        a.document.write('<th>No.</th>');
        a.document.write('<th>Product Name</th>');
        a.document.write('<th>Quantity</th>');
        a.document.write('<th class="text-center">Total</th>');
        a.document.write('</tr>');
        a.document.write('</thead>');
        a.document.write('</tbody>');
        a.document.write('@foreach($orders as $order)');
        a.document.write('<tr>');
        a.document.write('<td>{{$order->id}}</td>');
        a.document.write('<td>{{$order->item_name}}</td>');
        a.document.write('<td>{{$order->quantity}}</td>');
        a.document.write('<td>{{$order->price}}</td>');
        a.document.write('</tr>');
        a.document.write('@endforeach');
        a.document.write('@foreach($sub_totals as $sub_total)');
        a.document.write('<tr>');
        a.document.write('<td> </td>');
        a.document.write('<td> </td>');
        a.document.write('<td> </td>');
        a.document.write('<td class="text-right text-dark">');
        a.document.write('<h5><strong>Sub Total: Rs. {{$sub_total->subtotal}} </strong></h5>');
        a.document.write('</td>');
        a.document.write('<td class="text-center text-danger">');
        a.document.write('<h5 id="totalPayment"><strong> </strong></h5>');
        a.document.write('</td>');
        a.document.write('</tr>');
        a.document.write('@endforeach');
        a.document.write('</table>');
        a.document.write('</div>');
        a.document.write('</div>');

        a.document.write('</body></html>');
        a.document.write( "<link rel=\"stylesheet\" href=\"style.css\" type=\"text/css\" media=\"print\"/>" );
        a.document.close();
        a.print();
    }
</script>