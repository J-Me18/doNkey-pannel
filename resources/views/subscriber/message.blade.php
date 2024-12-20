<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Contact Admin</title>
    <!-- Include any necessary CSS styles here -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
        }
        .back-btn {
        
           height:59px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
          
        }
        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contact Your Admin</h1>
        <p>Please note that the subscriber's account has expired. Kindly remind the admin to renew the subscription.<br> Thank you.</p>
        <!-- You can replace the icon with any icon of your choice -->
       <button class="back-btn" onclick="window.history.back();" style="text-align:center;width:160px;">
    <i class="fa fa-arrow-left" aria-hidden="true" style="margin-right: 5px;"></i>
    <span style="font-size:17px;font-weight:700;">Back</span>
</button>

    </div>
</body>
</html>

