<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Step Process - Active State</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .steps-container {
      display: flex;
      justify-content: space-between;
      position: relative;
      margin: 50px auto;
      max-width: 900px;
    }

    .step {
      position: relative;
      text-align: center;
      flex: 1;
      padding: 10px;
    }

    /* เส้นระหว่างขั้น */
    .step::before {
      content: '';
      position: absolute;
      top: 25px;
      left: -50%;
      width: 100%;
      height: 4px;
      background-color: #ced4da; /* เทาอ่อน */
      z-index: -1;
      transition: background-color 0.3s ease;
    }

    .step:first-child::before {
      content: none;
    }

    .step .icon {
      background-color: #adb5bd; /* เทากลาง */
      color: white;
      width: 50px;
      height: 50px;
      line-height: 50px;
      border-radius: 50%;
      margin: 0 auto 10px;
      font-size: 20px;
      transition: all 0.3s ease-in-out;
    }

    .step .label {
      font-weight: 500;
      font-size: 16px;
      color: #495057;
    }

    /* สถานะ active */
    .step.active .icon {
      background-color: #0d6efd; /* สีฟ้า */
    }

    .step.active::before {
      background-color: #0d6efd; /* สีฟ้า */
    }
  </style>
</head>
<body>

<div class="container">
  <div class="steps-container">
    <div class="step active">
      <div class="icon"><i class="fas fa-play"></i></div>
      <div class="label">เริ่มต้น</div>
    </div>
    <div class="step active">
      <div class="icon"><i class="fas fa-cogs"></i></div>
      <div class="label">กำลังดำเนินการ</div>
    </div>
    <div class="step">
      <div class="icon"><i class="fas fa-check-circle"></i></div>
      <div class="label">ตรวจสอบ</div>
    </div>
    <div class="step">
      <div class="icon"><i class="fas fa-flag-checkered"></i></div>
      <div class="label">เสร็จสิ้น</div>
    </div>
  </div>
</div>

</body>
</html>
