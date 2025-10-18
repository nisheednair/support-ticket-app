<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bootstrap Step Progress</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .step {
      text-align: center;
      position: relative;
      flex: 1;
    }

    .step .circle {
      width: 40px;
      height: 40px;
      line-height: 40px;
      border-radius: 50%;
      background: #ddd;
      margin: 0 auto 10px;
      color: white;
    }

    .step.active .circle {
      background: #0d6efd;
    }

    .step.completed .circle {
      background: #198754;
    }

    .step::after {
      content: "";
      position: absolute;
      top: 20px;
      right: -50%;
      height: 2px;
      background: #ccc;
      width: 100%;
      z-index: -1;
    }

    .step:last-child::after {
      display: none;
    }

    .step.completed::after {
      background: #198754;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="d-flex justify-content-between">
    <div class="step completed">
      <div class="circle">1</div>
      <div>เริ่มต้น</div>
    </div>
    <div class="step active">
      <div class="circle">2</div>
      <div>กำลังดำเนินการ</div>
    </div>
    <div class="step">
      <div class="circle">3</div>
      <div>เสร็จสิ้น</div>
    </div>
  </div>
</div>

</body>
</html>
