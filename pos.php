<?php
session_start();
if (!isset($_SESSION["user"])) header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Point of Service</title>
    <style>
        * {
            padding: 0%;
            margin: 0%;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #ddc7c7;
        }

        li {
            display: flex;
            justify-content: center;
        }

        .header-inputs {
            display: flex;
            flex-direction: column;
        }

        input[type="text"] {
            display: flex;
            justify-content: center;
            width: 90%;
            margin: 5px;
            padding: 10px 5px;
            border-radius: 10px;
            margin-left: 10px;
            font-family: 'Times New Roman', Times, serif;
            font-size: large;
        }

        .item-container {
            background-color: gray;
            width: auto;
            overflow-y: auto;
            height: 300px;
            margin: 5px 10px;
        }

        .payment-type {
            float: right;
            margin-top: 10px;
        }

        select {
            padding: 10px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif
        }

        .checkout {
            display: flex;
            justify-content: center;
            padding: 60px 0px 0px 100px;
        }

        th {
            text-decoration: none;
            padding-right: 50px;

        }

        .quantity {
            width: 50px;
        }

        td {
            padding: 3px 10px;
        }
    </style>
</head>

<body>
    <nav>
        <ul>
            <li id="customer_header">
                <h1>Point Of Service</h1>
            </li>
        </ul>
    </nav>
    <div class="header-inputs">
        <input type="text" name="search" placeholder="Search to add item">
        <input type="text" name="customer" placeholder="Enter Customer Name">
    </div>
    <div class="item-container">
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <tr>

                </tr>
            </tbody>
        </table>
    </div>

    <div class="payment-type">
        <select name="payment-type" id="payment-type">
            <option value=""></option>
            <option value="cash">CASH</option>
            <option value="momo">MOMO</option>
        </select>
    </div>

    <div class="checkout"><input type="submit" value="CHECKOUT"></div>
</body>

</html>