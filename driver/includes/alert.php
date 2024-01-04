<?php
  if(isset($_SESSION['error'])){
    echo "
      <div class='alert alert-danger d-flex alert-dismissible' role='alert'>
        <span class='badge badge-center rounded-pill border-label-danger p-3 me-2'>😕</span>
        <div class='d-flex flex-column ps-1'>
          <h6 class='alert-heading d-flex align-items-center fw-bold mb-1'>Oops!</h6>
          <span>".$_SESSION['error']."</span>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
          </button>
        </div>
      </div>
    ";
    unset($_SESSION['error']);
  }
  if(isset($_SESSION['block'])){
    echo "
      <div class='alert alert-warning d-flex alert-dismissible' role='alert'>
        <span class='badge badge-center rounded-pill border-label-warning p-3 me-2'>😒</span>
        <div class='d-flex flex-column ps-1'>
          <h6 class='alert-heading d-flex align-items-center fw-bold mb-1'>Oh-Uh!</h6>
          <span>".$_SESSION['block']."</span>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
          </button>
        </div>
      </div>
    ";
    unset($_SESSION['block']);
  }
  if(isset($_SESSION['warning'])){
    echo "
      <div class='alert alert-warning d-flex alert-dismissible' role='alert'>
        <span class='badge badge-center rounded-pill border-label-warning p-3 me-2'>😒</span>
        <div class='d-flex flex-column ps-1'>
          <h6 class='alert-heading d-flex align-items-center fw-bold mb-1'>Hugh!</h6>
          <span>".$_SESSION['warning']."</span>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
          </button>
        </div>
      </div>
    ";
    unset($_SESSION['warning']);
  }
  if(isset($_SESSION['success'])){
    echo "
      <div class='alert alert-success d-flex alert-dismissible' role='alert'>
        <span class='badge badge-center rounded-pill border-label-success p-3 me-2'>🥳</span>
        <div class='d-flex flex-column ps-1'>
          <h6 class='alert-heading d-flex align-items-center fw-bold mb-1'>Hurray!</h6>
          <span>".$_SESSION['success']."</span>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
          </button>
        </div>
      </div>
    ";
    unset($_SESSION['success']);
  }
?>
