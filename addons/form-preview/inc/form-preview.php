<?php

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <style>
      .popup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.7);
    z-index: 1;
  }

  .popup-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  }

  .close-button {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    cursor: pointer;
  }


  .hideClass {
    display: none!important;
  }
  </style>
</head>
<body>
<div id="popup" class="popup">
        <div class="popup-content">
            <span class="close-button">&times;</span>
            <h2>Form Field Values</h2>
            <p><strong>Name:</strong> <span id="popupName"></span></p>
            <p><strong>Email:</strong> <span id="popupEmail"></span></p>
            <p><strong>Message:</strong> <span id="popupMessage"></span></p>
        </div>
    </div>
</body>
</html>