<!DOCTYPE html>
<html>
<head>
    <title>Product Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
</head>
<body>
    <div class="jumbotron text-center">
      <h1>Product Information</h1>
  </div>
  <div class="container">
      <div class="row">
          <div class="col-sm-12">
                  <form id="productForm">
                  <div class="row g-3">
                      <div class="col-sm">
                          <div class="form-group">
                              <label for="productName">Product Name:</label>
                              <input type="text" class="form-control" id="productName" name="productName" >
                          </div>
                      </div>
                      <div class="col-sm">

                          <div class="form-group">
                              <label for="price">Price:</label>
                              <input type="text" class="form-control" id="price" name="price" >
                          </div>

                      </div>

                      <div class="col-sm">
                          <div class="form-group">
                              <label for="offerPrice">Offer Price:</label>
                              <input type="text" class="form-control" id="offerPrice" name="offerPrice" >
                          </div>
                      </div>

                      <div class="col-sm">
                          <div class="form-group">
                              <label for="tax">Tax:</label>
                              <input type="text" class="form-control" id="tax" name="tax" >
                          </div>
                      </div>

                      <div class="col-sm">
                          <div class="form-group">
                                  <input type="button" class="btn btn-primary" id="addProduct" value="add" style="margin-bottom: -55px;">
                              <input type="submit" class="btn btn-success" id="submitBtn" value="Submit"style="margin-bottom: -55px;">
                          </div>
                      </div>

                      <div class="col-sm">
                          <div class="form-group">

                          </div>
                      </div>
                  </div>
                  </form>
              </div>
              <table id="productTable" class="table table-bordered">
                  <thead>
                  <tr>
                      <th>Product Name</th>
                      <th>Price</th>
                      <th>Offer Price</th>
                      <th>Tax</th>
                      <th>Sub Total</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                  <tr>
                      <th colspan="4">Total:</th>
                      <th id="totalAmount">0</th>
                  </tr>
                  </tfoot>
              </table>
          </div>
</div>
</div>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var productCount = 0;
            var totalAmount = 0;

            $('#addProduct').click(function() {
                var productName = $('#productName').val();
                var price = parseFloat($('#price').val());
                var offerPrice = parseFloat($('#offerPrice').val());
                var tax = parseFloat($('#tax').val());

                //var subTotal = (offerPrice || price) + (offerPrice || price) * (tax / 100.00);

                if (productName === '' || isNaN(price) || isNaN(offerPrice) || isNaN(tax)) {
                    alert('Please fill in all the fields with valid values.');
                    return;
                }

                if(offerPrice > price){
                    alert("Offer Price can not be Greanter then Normal price");
                    return;
                }

                var subTotal = (offerPrice) +(tax);

                totalAmount += subTotal;

                var row = '<tr>' +
                '<td>' + productName + '</td>' +
                '<td>' + price + '</td>' +
                '<td>' + offerPrice + '</td>' +
                '<td>' + tax + '</td>' +
                '<td>' + subTotal + '</td>' +
                '</tr>';

                $('#productTable tbody').append(row);
                $('#totalAmount').text(totalAmount.toFixed(2));

                // Clear the input fields
                $('#productName').val('');
                $('#price').val('');
                $('#offerPrice').val('');
                $('#tax').val('');
            });

            $('#productForm').submit(function(e) {
                e.preventDefault(); // Prevent form submission

                // Get all product details from table rows
                var products = [];
                $('#productTable tbody tr').each(function() {
                    var productName = $(this).find('td:nth-child(1)').text();
                    var price = parseFloat($(this).find('td:nth-child(2)').text());
                    var offerPrice = parseFloat($(this).find('td:nth-child(3)').text());
                    var tax = parseFloat($(this).find('td:nth-child(4)').text());
                    var subTotal = parseFloat($(this).find('td:nth-child(5)').text());

                    var product = {
                        productName: productName,
                        price: price,
                        offerPrice: offerPrice,
                        tax: tax,
                        subTotal: subTotal
                    };
                    products.push(product);
                });

                // Perform validation if necessary

                // Submit the form data
                $.ajax({
                    url: 'store_data.php',
                    method: 'POST',
                    data: {
                        products: products
                    },
                    success: function(response) {
                        alert(response);
                        // Optionally, you can reset the form and clear the table
                        $('#productForm')[0].reset();
                        $('#productTable tbody').empty();
                        $('#totalAmount').text('0');
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred while storing data: ' + error);
                    }
                });
            });
        });
    </script>
</body>
</html>