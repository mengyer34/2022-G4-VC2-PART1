<!DOCTYPE html>
<html lang="en">
<head>
    <style type="text/css">
        body {
            background-color: #D1D5DB;  
            font-family: sans-serif;
        }
        .main-container {
            background-color: #D1D5DB;  
            height: 100vh;
        }
        .container {
            margin: 0 auto;
            display: block; 
            position: relative; 
            background-color: #ffffff; 
            width: 70%; 
            border-radius: 0.5rem; 
            border-width: 0; 
            outline: 0; 
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); 
        }
        .header-container h3 {
            font-size: 1.5rem; 
            font-weight: 600; 
            text-align: center; 
        }
        .body-container {
            padding: 1rem; 
            width: 91.666667%; 
        }
        table {
            margin-top: -1.5rem;
            background-color: #ffffff; 
            width: 100%; 
            border-width: 1px; 
            border-collapse: collapse;
        }
        table tr:hover {
            background: #F5F5F5;
        }
        tr{
            border: 1px solid grey;
        }
        tr .title {
            font-weight: bold;
        }
        tr td {
            text-align: center; 
            border-width: 1px; 
            color: 13px;
            color: #6E6E6E;
            padding: 1rem;
            border-right: 1px solid grey;
        }
        .footer-container {
            display: flex; 
            margin-top: 0.75rem; 
            justify-content: flex-end; 
            align-items: center; 
        }
        .footer-container button {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem; 
            padding-left: 1.3rem;
            padding-right: 1.3rem; 
            color: #ffffff; 
            border-radius: 0.25rem; 
            border: none;
        }
        button.reject {
            background-color: #DC2626; 
        }
        button.reject:hover {
            background-color: #ea5b5b; 
        }
        button.approve {
            background-color: #3B82F6;  
            margin-left: 10px;
        }
        button.approve:hover {
            background-color: #80a8e9; 
        }
    </style>
</head>
<body>
    <div class="container">
        <!--header-->
        <div class="header-container">
          <h3>
            Request Leave Imformation
          </h3>
        </div>
        <!--body-->
        <div class="body-container">
          <table>
            <tbody>
              <tr>
                <td class="title">Reason</td>
                <td>{{ $details['reason'] }}</td>
              </tr>
              <tr>
                <td class="title">Leave Type</td>
                <td>{{ $details['leave_type'] }} </td>
              </tr>
              <tr>
                <td class="title">Start Date</td>
                <td>{{ $details['start_date'] }} {{$details['start_time']}}</td>
              </tr>
              <tr>
                <td class="title">End Date</td>
                <td>{{ $details['end_date'] }} {{$details['end_time']}}</td>
              </tr>
              <tr>
                <td class="title">Status</td>
                <td>Panding </td>
              </tr>
              <tr>
                <td class="title">Duration</td>
                <td>{{ $details['duration'] }}</td>
              </tr>
              <tr>
                <td class="title">Requested</td>
                <td>{{date("F j, Y, g:i a")}}</td>
              </tr>
            </tbody>
          </table>
          <div class="footer-container">
              <button class="reject">
                  Reject
              </button>
              <button class="approve">
                  Approve
              </button>
          </div>
        </div>
    </div>
</body>
</html>
