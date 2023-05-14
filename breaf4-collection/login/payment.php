<?php require 'db.php'; ?>

<?php require 'header.php'; ?>

<div class="container">
  <div class="row mt-5">
    <div class="col-md-6">
    <div class="card p-4">
        <h3 class="text-center mb-4">Payment Options</h3>
        <div class="d-flex align-items-center">
            <div class="d-flex flex-column ">
                <a href="" class="btn btn-danger btn-lg mb-3">Pay with Debit or Credit Card</a>
                <a href="" class="btn btn-danger btn-lg">Pay with PayPal</a>
                <img src="paypal.png" alt="" width="480px" height="100px" class="ml-3">
            </div>
        </div>
    </div>
      <div class="card mt-5 p-4">
        <h3 class="text-center mb-4">Order Summary</h3>
        <table class="table">
          <thead>
            <tr>
              <th>Item</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Subtotal</td>
              <td>$150</td>
            </tr>
            <tr>
              <td>Shipping</td>
              <td>$50</td>
            </tr>
            <tr>
              <td><strong>Total</strong></td>
              <td><strong>$200</strong></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-4">
        <h3 class="text-center mb-4">Billing Address</h3>
        <form action="payment.php">
          <div class="mb-3">
            <label for="">City</label>
            <input type="text" class="form-control" placeholder="Enter your city">
          </div>
          <div class="mb-3">
            <label for="">Region</label>
            <input type="text" class="form-control" placeholder="Enter your region">
          </div>
          <div class="mb-3">
            <label for="">Neighborhood</label>
            <input type="text" class="form-control" placeholder="Enter your neighborhood">
          </div>
          <div class="mb-3">
            <label for="">Building Number</label>
            <input type="text" class="form-control" placeholder="Enter your building number">
          </div>
          <div class="mb-3">
            <label for="">Contact Phone Number</label>
            <input type="text" class="form-control" placeholder="Enter your phone number">
          </div>
          <div class="mb-3">
            <label for="">Say Something</label>
            <input type="text" class="form-control" placeholder="Enter a message">
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">Complete Payment Now</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require 'footer.php'; ?>