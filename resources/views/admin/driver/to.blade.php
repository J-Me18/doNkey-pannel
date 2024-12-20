<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toggle Button</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom CSS -->
    <style>
        /* Style the label for the toggle button */
        .custom-control-label::before {
            background-color: #007bff; /* Color when unchecked */
            color: #fff; /* Text color when unchecked */
        }
        .custom-control-label::after {
            background-color: #28a745; /* Color when checked */
            color: #fff; /* Text color when checked */

        box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset;
    border-color: rgb(223, 223, 223);
    background-color: rgb(255, 255, 255);
    transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s;
}
.switchery-small {
    border-radius: 20px;
    height: 20px;
    width: 33px;
}
.switchery {
    background-color: #fff;
    border: 1px solid #dfdfdf;
    border-radius: 20px;
    cursor: pointer;
    display: inline-block;
    height: 30px;
    position: relative;
    vertical-align: middle;
    width: 50px;
    -moz-user-select: none;
    -khtml-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
    user-select: none;
    box-sizing: content-box;
    background-clip: content-box;
}
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Toggle Button Example</h2>
        <input type="checkbox" data-id="45" name="status" class="js-switch" data-switchery="true" style="display: none;">
        <span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset;border-color: rgb(223, 223, 223);background-color: rgb(255, 255, 255);transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s;"><small style="left: 0px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>
        <small style="left: 0px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>
    </div>
</body>
</html>
