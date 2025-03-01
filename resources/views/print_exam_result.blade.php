<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print the Exam Result</title>
    <style>
        @page {
            size: 8.3in 11.7in;
        }
        @page {
            size: A4;
        }
        .page-container {
            display: flex;
        }
        .page-container h2{
            font-size: 20px;
        }
        .margin-bottom  {
            margin-bottom: 3px;
        }
        .table-bg {
            border-collapse: collapse;
            width: 100%;
            font-size: 15px;
            text-align: center;
        }

        .table-bg th {
            border: 1px solid;
            padding: 10px;
        }

        .table-bg td {
            border: 1px solid;
            padding: 3px;
        }

        .table-bg .text-container {
            text-align: left;
            padding-left: 5px;
        }

        @media print {
            @page {
                margin: 0;
                margin-left: 20px;
                margin-right: 20px;
            }
        }
    </style>
</head>
<body>
    <div id="page">
        <div class="page-container">
            <table style="width: 50%">
                <tr>
                    <td width="5%"></td>
                    <td width="15%"><img style="width: 80px;" src="http://localhost/laravel/schoolmanagement/upload/setting/20250225100153i9ksjckvx0.png" alt=""></td>
                    <td align="center">
                        <h2>HANOI UNIVERSITY OF NATURAL ESOURCES AND ENVIRONMENT</h2>
                    </td>
                    <td></td>
                </tr>
            </table>
            <table style="width: 50%; float: right;">
                <tr>
                    <td width="5%"></td>
                    <td align="center">
                        <h2>SOCIALIST REPUBLIC OF VIETNAM <br>
                            <span style="font-size: 16px;">Independence – Liberty – Happiness</span>
                        </h2>
                        <br>

                    </td>
                    <td></td>
                </tr>
            </table>
        </div>

        <table style="width: 100%; text-align: center;">
            <tr>
                <td width="5%"></td>
                <td align="center">
                    <h2>SCORE TABLE</h2>
                </td>
                <td></td>
            </tr>
        </table>

        <table style="width: 100%">
            <tr>
                <td width="5%"></td>
                <td width="70%">
                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td width="27%">Name Of Student: </td>
                                <td style="border-bottom:1px solid; width:100%"></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td width="23%">Admission No: </td>
                                <td style="border-bottom:1px solid; width:100%"></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td width="23%">Class: </td>
                                <td style="border-bottom:1px solid; width:100%"></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td width="28%">Academic Session: </td>
                                <td style="border-bottom:1px solid; width:20%"></td>
                                <td width="11%">Term: </td>
                                <td style="border-bottom:1px solid; width:80%"></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td width="19%">Total Score: </td>
                                <td style="border-bottom:1px solid; width:50%"></td>
                                <td width="16%">Average: </td>
                                <td style="border-bottom:1px solid; width:50%"></td>
                            </tr>
                        </tbody>
                    </table>

                </td>
                <td width="5%"></td>
                <td width="20%" valign="top">
                    <img style="border-radius: 6px; height: 100px; width: 100px;" src="http://localhost/laravel/schoolmanagement/upload/profile/20250202040109hqca1akp2e8dxvyc9lkb.jpg" alt="">
                    <br>
                    Gender: Male
                </td>
            </tr>
        </table>
        <br>
        <div>
            <table class="table-bg">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Class Work</th>
                        <th>Home Work</th>
                        <th>Test Work</th>
                        <th>Exam</th>
                        <th>Total Score</th>
                        <th>Passing Marks</th>
                        <th>Full Marks</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-container">Vat ly dai cuong</td>
                        <td>32</td>
                        <td>12</td>
                        <td>32</td>
                        <td>12</td>
                        <td>88</td>
                        <td>70</td>
                        <td>100</td>
                        <td>
                            <span style="color: green; font-weight: bold;">Pass</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-container">Vat ly dai cuong</td>
                        <td>32</td>
                        <td>12</td>
                        <td>32</td>
                        <td>12</td>
                        <td>88</td>
                        <td>70</td>
                        <td>100</td>
                        <td>
                            <span style="color: green; font-weight: bold;">Pass</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-container">Vat ly dai cuong</td>
                        <td>32</td>
                        <td>12</td>
                        <td>32</td>
                        <td>12</td>
                        <td>88</td>
                        <td>70</td>
                        <td>100</td>
                        <td>
                            <span style="color: green; font-weight: bold;">Pass</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-container">Vat ly dai cuong</td>
                        <td>32</td>
                        <td>12</td>
                        <td>32</td>
                        <td>12</td>
                        <td>88</td>
                        <td>70</td>
                        <td>100</td>
                        <td>
                            <span style="color: green; font-weight: bold;">Pass</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-container">Vat ly dai cuong</td>
                        <td>32</td>
                        <td>12</td>
                        <td>32</td>
                        <td>12</td>
                        <td>88</td>
                        <td>70</td>
                        <td>100</td>
                        <td>
                            <span style="color: green; font-weight: bold;">Pass</span>
                        </td>
                    </tr>
                    <tr>
                        {{-- <td colspan="2">
                            <b style="font-weight: bold;">Final Result</b>
                        </td> --}}
                        <td colspan="3">
                            <b>Grand Total: 266/300</b>
                        </td>
                        <td colspan="3">
                            <b>Percentage: 88.67%</b>
                        </td>
                        <td colspan="2">
                            <b>Grade: A</b>
                        </td>
                        <td colspan="1">
                            <b style="color: green;">Pass</b>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
            when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            It has survived not only five centuries, but also the leap into electronic typesetting,
            remaining essentially unchanged
        </div>

        <table class="margin-bottom" style="width: 100%">
            <tbody>
                <tr>
                    <td width="15%">Signature: </td>
                    <td style="border-bottom:1px solid; width:100%"></td>
                </tr>
            </tbody>
        </table>

    </div>



    <script>
        // window.print();
    </script>
</body>
</html>
