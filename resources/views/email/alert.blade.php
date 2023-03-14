<!DOCTYPE html>
<html>
    <head>
        <style>
            #table {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #table td, #table th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #table tr:nth-child(even){background-color: #f2f2f2;}

            #table tr:hover {background-color: #ddd;}

            #table th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #030a47d4;
                color: white;
            }
        </style>
    </head>
    <body>

        <h1>{{ $log['title'] }}</h1>

        <table id="table">
            <tr>
                <th>Parameter</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>
                    Created At
                </td>
                <td>
                    {{$log['data']->created_at}}
                </td>
            </tr>
            <tr>
                <td>
                    Main Dealer
                </td>
                <td>
                    {{$log['data']->main_dealer->name}}
                </td>
            </tr>
            <tr>
                <td>
                    Feature
                </td>
                <td>
                    {{$log['data']->feature_name}}
                </td>
            </tr>
            <tr>
                <td>
                    URL
                </td>
                <td>
                    {{$log['data']->url}}
                </td>
            </tr>
            </tr>
            <tr>
                <td>
                    Request
                </td>
                <td>
                    Headers => {{$log['data']->request_header}}
                    <br><br>
                    Body => {{$log['data']->request_payload}}
                </td>
            </tr>
            <tr>
                <td>
                    Status Code
                </td>
                <td>
                    @if($log['data']->status_code_validation == true)
                        <span style="color:green;"> SUCCESS </span>
                    @else
                        <span style="color:red; font-weight: bold"> FAILED </span>
                    @endif
                    <br>
                    Factual => {{$log['data']->status_code_factual}}
                    <br>
                    Actual => {{$log['data']->status_code_actual}}
                </td>
            </tr>
            <tr>
                <td>
                    Response Time
                </td>
                <td>
                    @if($log['data']->response_time_validation == true)
                        <span style="color:green;"> SUCCESS </span>
                    @else
                        <span style="color:red; font-weight: bold"> FAILED </span>
                    @endif
                    <br>
                    Factual => {{$log['data']->response_time}}
                    <br>
                    Actual => {{$log['data']->response_time_accumulation}}
                </td>
            </tr>
            <tr>
                <td>
                    Response Body
                </td>
                <td>
                    @if($log['data']->response_body_validation == true)
                        <span style="color:green;"> SUCCESS </span>
                    @else
                        <span style="color:red; font-weight: bold"> FAILED </span>
                    @endif
                    <br>
                    Factual => {{$log['data']->response_body_factual}}
                    <br>
                    Actual => {{$log['data']->response_body_actual}}
                </td>
            </tr>
        </table>

    </body>
</html>