
    function calculateGST() {
        var qtyInput = document.getElementById('pqty');
        var mrpInput = document.getElementById('mrp');
        var gstInput = document.getElementById('pgst');
        var totalInput = document.getElementById('ptot');
        
        var qty = parseFloat(qtyInput.value);
        var mrp = parseFloat(mrpInput.value);
        
        // Check if qty is not NaN and greater than 0
        if (!isNaN(qty) && qty > 0) {
            var total = qty * mrp; // Calculate total amount
            var taxableValue = (mrp * qty * 100) / 105; // Calculate GST amount
            
            var gstAmount = total - taxableValue;
            gstInput.value = gstAmount.toFixed(2); // Display GST amount with 2 decimal places
            totalInput.value = total.toFixed(2); // Display total amount with 2 decimal places
        } else {
            // If qty is NaN or 0, set GST and total to empty
            gstInput.value = "";
            totalInput.value = "";
        }
        calculateTotal();
    }

    function calculateTotal() {
        
        var total = 0;
        var productRows = document.querySelectorAll('#productTable tbody tr');
        
        productRows.forEach(function(row) {
            var qtyCell = row.querySelector('.qty');
            var mrpCell = row.querySelector('.mrp');
            var totalCell = row.querySelector('.total');
            
            var qty = parseFloat(qtyCell.textContent);
            var mrp = parseFloat(mrpCell.textContent);
            
            if (!isNaN(qty) && qty > 0 && !isNaN(mrp)) {
                var productTotal = qty * mrp;
                total += productTotal;
                totalCell.textContent = productTotal.toFixed(2);
            } else {
                totalCell.textContent = ""; // Clear cell if values are not valid
            }
        });
        
        document.getElementById('total').textContent = total.toFixed(2);
        document.getElementById('total_amount').value = total.toFixed(2);
    }
    


var rowCounter = 0; // Move the initialization here
// Find the maximum row number in the existing table rows
function findMaxiproductRowNumber() {
    // alert("increment");
    // Find the maximum row number in the existing table rows
    $('#productTable tbody tr').each(function(index, element) {
        var currentRowNumber = parseInt($(element).find('td:eq(0)').text(), 10);
        rowCounter = Math.max(rowCounter, currentRowNumber);
    });
} 
function addProduct() {

     // Call the function to find the maximum row number
     findMaxiproductRowNumber();
    // Get the selected values from the first two select boxes
    var selectBox1 = document.getElementById("prod").value;
    var selectBox2 = document.getElementById("mrp").value;
    var selectBox3 = document.getElementById("pqty").value;
    // Check if both select boxes are selected
    // if (selectBox1.selectedIndex === -1 || selectBox2.selectedIndex === -1) {
    if (selectBox1 === "" || selectBox2 === "" || selectBox3 === "") {
        alert("Please select values for the Product, Qty & Mrp.");
        return; // Exit the function if not selected
    }
    var table = document.getElementById("productTable");
    var tbody = table.getElementsByTagName("tbody")[0]; // Get the tbody element
    var newRow = tbody.insertRow(tbody.rows.length); // Insert row into tbody

    // Generate a unique identifier for the row
    var rowId = "row_" + (new Date().getTime()); // You can use a more robust method based on your needs

    // Numbering Column
    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = ++rowCounter; // Increment before setting the innerHTML

    // Set the unique identifier as a data attribute
    newRow.setAttribute('data-rowid', rowId);

    // Select Box 1
    var cell2 = newRow.insertCell(1);
    var selectBox1 = document.getElementById("prod");
    cell2.innerHTML = selectBox1.options[selectBox1.selectedIndex].text;

    // Select Box 2
    var cell3 = newRow.insertCell(2);
    var selectBox2 = document.getElementById("prod");
    cell3.innerHTML = selectBox1.options[selectBox1.selectedIndex].value;
    cell3.classList.add('hidden-cell');


    var cell4 = newRow.insertCell(3);
    var textBox1 = document.getElementById("pqty");
    cell4.innerHTML = textBox1.value;
    cell4.classList.add('qty');

     // Text Box 1
    var cell5 = newRow.insertCell(4);
    var textBox2 = document.getElementById("mrp");
    cell5.innerHTML = textBox2.value;
    cell5.classList.add('mrp');

    // Text Box 2
    var cell6 = newRow.insertCell(5);
    var textBox3 = document.getElementById("pgst");
    cell6.innerHTML = textBox3.value;

    var cell7 = newRow.insertCell(6);
    var textBox4 = document.getElementById("ptot");
    cell7.innerHTML = textBox4.value;
    cell7.classList.add('total');
    
    // New cell with Edit and Delete buttons  ===========href='edit-supplier.php?edit=" + ++rowCounter + "'---onclick='javascript:confirmationDelete($(this));return false;
    var cell8 = newRow.insertCell(7);
    cell8.innerHTML = "<a class='btn btn-sm btn-primary edit-btn'  data-bs-target='#suppliermodal' data-bs-toggle='modal' title='Edit' style='color:white'>" +
        "<span class='fe fe-edit'> </span></a>&nbsp;&nbsp;" +
        "<a class='btn btn-sm btn-danger delete-btn'  id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'>" +
        "<span class='fe fe-trash-2'> </span></a>";

    var cell9 = newRow.insertCell(8);
    cell9.innerHTML = "New";
    cell9.classList.add('hidden-cell');

    var cell10 = newRow.insertCell(9);
    cell10.innerHTML = "";
    cell10.classList.add('hidden-cell');

    // Clear input values after adding to the table
    textBox2.value = "";
    textBox1.value = "1";
    textBox3.value = "";
    textBox4.value = "";
    // Clear select box values
    selectBox1.selectedIndex = -1;
    calculateTotal();
}
document.getElementById('prod').addEventListener('change', function () {
    var selectedOption = this.options[this.selectedIndex];
    var productmrp = selectedOption.getAttribute('data-questions');
    // var selectedOrderId = selectedOption.value;
    // alert(productmrp);
    $('#mrp').val(productmrp);
    $('#ptot').val(productmrp);
    calculateGST();
});

// Add a click event listener for the "Edit" buttons
$('body').on('click', '.edit-btn', function () {
   
    // Get the corresponding row
    var row = $(this).closest('tr');

    // Extract values from the row
    var pname = row.find('td:eq(1)').text(); // Replace 1 with the actual column index
    var pid = row.find('td:eq(2)').text();
    var qty = row.find('td:eq(3)').text();
    var mrp = row.find('td:eq(4)').text(); // Replace 3 with the actual column index
    var gst = row.find('td:eq(5)').text();
    var total = row.find('td:eq(6)').text(); // Replace 5 with the actual column index

    var rowId = row.data('rowid'); // Assuming you have a data-rowid attribute on your row

    // Set values in the modal

    $('#modalpname').val(pname);
    $('#modalpid').val(pid);
    $('#modalqty').val(qty);
    $('#modalmrp').val(mrp);
    $('#modalgst').val(gst);
    $('#modaltotal').val(total);

    // Set the value of the new textbox
    $('#modalrowid').val(rowId);

    // Trigger the modal to display
    $('#suppliermodal').modal('show');
});



$('body').on('click', '.delete-btn', function () {
    // Get the corresponding row
    var row = $(this).closest('tr');

     // Retrieve data from a particular column (for example, the third column)
     var specificColumnData1 = row.find('td:nth-child(10)').text().trim();

    // Confirmation dialog before deleting
    if (confirm("Are you sure you want to delete this Product?")) {
        // Perform the AJAX request to delete the row from the server
        $.ajax({
            url: 'delete_product_row.php', // Replace with the actual URL of your server-side script
            type: 'POST',
            data: { specificColumnData1: specificColumnData1 },
            success: function(response) {
                // Assuming the server returns a success message
                // if (response.success) {
                    // Remove the row from the table
                    row.remove();
                    calculateTotal();
                    // Optionally, update the numbering in the first column of remaining rows
                    updateRowNumbers();
                    alert("Successfully Deleted Product")
                // } else {
                //     alert('Failed to delete the row: ' + response.message);
                // }
            },
            error: function(xhr, status, error) {
                alert('An error occurred while deleting the row: ' + error);
            }
        });
    }
});

function updateRowNumbers() {
    // Update the numbering in the first column of each remaining row
    $('#productTable tbody tr').each(function (index, element) {
        $(element).find('td:eq(0)').text(index + 1);
    });
}

// Add a click event listener for the "Save changes" button in the modal
$('#saveChangesBtn').on('click', function () {

    // Get the values from the modal fields
    var pname = $('#modalpname').val();
    var pid = $('#modalpid').val();
  
    var qty = $('#modalqty').val();
    var mrp = $('#modalmrp').val();
    var gst = $('#modalgst').val();
    var total = $('#modaltotal').val();
    
    var pstatus= "Edited";
  
    // Get the selected row in the table (assuming it has an id, adjust as needed)
    var selectedRowId = $('#modalrowid').val(); // Update this to the actual input or method to get the row ID

    // Update the corresponding row in the table
    var selectedRow = $('#productTable tbody tr[data-rowid="' + selectedRowId + '"]');
    selectedRow.find('td:eq(1)').text(pname); // Update with the correct column indices.
    selectedRow.find('td:eq(2)').text(pid); // Update with the correct column indices.
    selectedRow.find('td:eq(3)').text(qty); // Update with the correct column indices
    selectedRow.find('td:eq(4)').text(mrp); // Update with the correct column indices
    selectedRow.find('td:eq(5)').text(gst); // Update with the correct column indices
    selectedRow.find('td:eq(6)').text(total); // Update with the correct column indices
   
  selectedRow.find('td:eq(8)').text(pstatus); // Update with the correct column indices
    // Hide the modal
    $('#suppliermodal').modal('hide');
    calculateTotal()
});

// ************************payment table********************
var rowCounter1 = 0; // Move the initialization here
// Find the maximum row number in the existing table rows
function findMaxipaymentRowNumber() {
    // alert("increment");
    // Find the maximum row number in the existing table rows
    $('#paymentTable tbody tr').each(function(index, element) {
        var currentRowNumber1 = parseInt($(element).find('td:eq(0)').text(), 10);
        rowCounter1 = Math.max(rowCounter1, currentRowNumber1);
    });
} 
function addPayment() {

     // Call the function to find the maximum row number
     findMaxipaymentRowNumber();
    // Get the selected values from the first two select boxes
    var selectBox1 = document.getElementById("ptype");
    var selectBox2 = document.getElementById("modofpay");
    var selectBox3 = document.getElementById("paytotal").value;
    // Check if both select boxes are selected
    if (selectBox1.selectedIndex === -1 || selectBox2.selectedIndex === -1 || selectBox3 === "") {
    // if (selectBox1 === "" || selectBox2 === "" || selectBox3 === "") {
        alert("Please select values for the Payment Type, Mode of Pay & Total .");
        return; // Exit the function if not selected
    }
    var table = document.getElementById("paymentTable");
    var tbody = table.getElementsByTagName("tbody")[0]; // Get the tbody element
    var newRow = tbody.insertRow(tbody.rows.length); // Insert row into tbody

    // Generate a unique identifier for the row
    var rowId = "row_" + (new Date().getTime()); // You can use a more robust method based on your needs

    // Numbering Column
    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = ++rowCounter1; // Increment before setting the innerHTML

    // Set the unique identifier as a data attribute
    newRow.setAttribute('data-rowid', rowId);

    // Select Box 1
    var cell2 = newRow.insertCell(1);
    var selectBox1 = document.getElementById("ptype");
    cell2.innerHTML = selectBox1.options[selectBox1.selectedIndex].text;

    var cell3 = newRow.insertCell(2);
    var selectBox2 = document.getElementById("modofpay");
    cell3.innerHTML = selectBox2.options[selectBox2.selectedIndex].text;


     // Text Box 1
    var cell4 = newRow.insertCell(3);
    var textBox2 = document.getElementById("paytotal");
    cell4.innerHTML = textBox2.value;
   

    // Text Box 2
    var cell5 = newRow.insertCell(4);
    var textBox3 = document.getElementById("pdate");
    cell5.innerHTML = textBox3.value;

   
    
    // New cell with Edit and Delete buttons  ===========href='edit-supplier.php?edit=" + ++rowCounter + "'---onclick='javascript:confirmationDelete($(this));return false;
    var cell6 = newRow.insertCell(5);
    cell6.innerHTML = "<a class='btn btn-sm btn-primary edit-pay-btn'  data-bs-target='#paymentmodal' data-bs-toggle='modal' title='Edit' style='color:white'>" +
        "<span class='fe fe-edit'> </span></a>&nbsp;&nbsp;" +
        "<a class='btn btn-sm btn-danger delete-pay-btn'  id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'>" +
        "<span class='fe fe-trash-2'> </span></a>";

    var cell7 = newRow.insertCell(6);
    cell7.innerHTML = "New";
    cell7.classList.add('hidden-cell');

    var cell8 = newRow.insertCell(7);
    cell8.innerHTML = "";
    cell8.classList.add('hidden-cell');
    
    // Clear input values after adding to the table
    textBox2.value = "";

    textBox3.value = "";
 
    // Clear select box values
    selectBox1.selectedIndex = -1;
    selectBox2.selectedIndex = -1;
}

// Add a click event listener for the "Edit" buttons
$('body').on('click', '.edit-pay-btn', function () {
    // alert ("gfd");
    // Get the corresponding row
    var row = $(this).closest('tr');

    // Extract values from the row
    var ptype = row.find('td:eq(1)').text(); // Replace 1 with the actual column index
    var pmode = row.find('td:eq(2)').text();
    // alert (pmode);
    var pamt = row.find('td:eq(3)').text();
    var pdate = row.find('td:eq(4)').text(); // Replace 3 with the actual column index
   

    var rowId = row.data('rowid'); // Assuming you have a data-rowid attribute on your row

    // Set values in the modal
    $('#modalpaytype').val(ptype).trigger('change');
    $('#modalpaymenttransmode').val(pmode).trigger('change');
    $('#modalpaymentamt').val(pamt);
    $('#modalcuspayDate').val(pdate);
   
    // Set the value of the new textbox
    $('#modalpayrowid').val(rowId);

    // Trigger the modal to display
    $('#paymentmodal').modal('show');
});

$('body').on('click', '.delete-pay-btn', function () {
    // Get the corresponding row
    var row = $(this).closest('tr');

     // Retrieve data from a particular column (for example, the third column)
     var specificColumnData = row.find('td:nth-child(8)').text().trim();
    // alert (specificColumnData);
    // Confirmation dialog before deleting
    if (confirm("Are you sure you want to delete this Payment Details?")) {
        // Perform the AJAX request to delete the row from the server
        $.ajax({
            url: 'delete_payment_row.php', // Replace with the actual URL of your server-side script
            type: 'POST',
            data: { specificColumnData: specificColumnData },
            success: function(response) {
                // Assuming the server returns a success message
                // if (response.success == true) {
                    // Remove the row from the table
                    row.remove();
                    // Optionally, update the numbering in the first column of remaining rows
                    updatepayRowNumbers();
                    alert('Successfully deleted the row: ');
                // } else {
                //     alert('Failed to delete the row: ' + response.message);
                // }
            },
            error: function(xhr, status, error) {
                alert('An error occurred while deleting the row: ' + error);
            }
        });
    }
});


function updatepayRowNumbers() {
    // Update the numbering in the first column of each remaining row
    $('#paymentTable tbody tr').each(function (index, element) {
        $(element).find('td:eq(0)').text(index + 1);
    });
}

// Add a click event listener for the "Save changes" button in the modal
$('#savepayChangesBtn').on('click', function () {
    // Get the values from the modal fields
    var modalpaytype = $('#modalpaytype').val();
    var modalpaymenttransmode = $('#modalpaymenttransmode').val();
  
    var modalpaymentamt = $('#modalpaymentamt').val();
    var modalcuspayDate = $('#modalcuspayDate').val();
    
    
    var pstatus= "Edited";
   
    // Get the selected row in the table (assuming it has an id, adjust as needed)
    var selectedRowId = $('#modalpayrowid').val(); // Update this to the actual input or method to get the row ID

    // Update the corresponding row in the table
    var selectedRow = $('#paymentTable tbody tr[data-rowid="' + selectedRowId + '"]');
    selectedRow.find('td:eq(1)').text(modalpaytype); // Update with the correct column indices.
    selectedRow.find('td:eq(2)').text(modalpaymenttransmode); // Update with the correct column indices.
    selectedRow.find('td:eq(3)').text(modalpaymentamt); // Update with the correct column indices
    selectedRow.find('td:eq(4)').text(modalcuspayDate); // Update with the correct column indices
  
  selectedRow.find('td:eq(6)').text(pstatus); // Update with the correct column indices
    // Hide the modal
    $('#paymentmodal').modal('hide');
});


// ============start data saving code================================
function saveDataToDatabase() {

    var editid = document.getElementById("editid").value;

    // *********** supplier details *************
    var table = document.getElementById("productTable");
    var rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
    console.log("hai productTable   :" + rows)
    var supplierdataToSave = [];

    // Iterate through each row
    for (var i = 0; i < rows.length; i++) {
        console.log(i);
        var row = rows[i];
        var cells = row.getElementsByTagName("td");

        var rowData = {
            pname: cells[1].innerHTML, // Adjust the index based on your table structure
            pid: cells[2].innerHTML, // Adjust the index based on your table structure
            qty: cells[3].innerHTML, // Adjust the index based on your table structure
            mrp: cells[4].innerHTML, // Adjust the index based on your table structure
            gst: cells[5].innerHTML, // Adjust the index based on your table structure
            total: cells[6].innerHTML, // Adjust the index based on your table structure
            payStatus: cells[8].innerHTML, // Adjust the index based on your table structure
            productid: cells[9].innerHTML,
            // Add more fields as needed
        };

        supplierdataToSave.push(rowData);
    }
    console.log(rowData);
    // **********payment details *********************

    var table1 = document.getElementById("paymentTable");
    var rows1 = table1.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
    console.log("hai  payments :" + rows1)
    var paymentdataToSave = [];

    // Iterate through each row
    for (var i = 0; i < rows1.length; i++) {
        console.log(i);
        var row = rows1[i];
        var cells = row.getElementsByTagName("td");

        var rowData1 = {
            // orderid: document.getElementById("ordersdisplay").value,
            PaymentType: cells[1].innerHTML, // Adjust the index based on your table structure
            TransactionMode: cells[2].innerHTML, // Adjust the index based on your table structure
            PaymentAmount: cells[3].innerHTML, // Adjust the index based on your table structure
            cuspayDate: cells[4].innerHTML, // Adjust the index based on your table structure
            payStatus: cells[6].innerHTML,
            paymentid: cells[7].innerHTML,
        };

        paymentdataToSave.push(rowData1);
    }
    console.log(rowData1);
    // ==================== other details================
    var followupdataToSave = [];
    var custname = document.getElementById("custname").value;
    var odate = document.getElementById("odate").value;
    var cinfo = document.getElementById("cinfo").value;
    var ddate = document.getElementById("ddate").value;
    var dtime = document.getElementById("dtime").value;
    var addlocation = document.getElementById("addlocation").value;
    var dassets = document.getElementById("dassets").value;
    var ordertype = document.getElementById("ordertype").value;
    var branch = document.getElementById("branch").value;
    var dgoogle = document.getElementById("dgoogle").value;
    var radios = document.getElementsByName('Radio');
    var selectedValue;
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            selectedValue = radios[i].value;
            break;
        }
    }
    var status = document.getElementById("status").value;
    var totamt = document.getElementById("total_amount").value;
    var rowData1 = {
        custname: custname, // Adjust the index based on your table structure
        odate: odate, // Adjust the index based on your table structure
        cinfo: cinfo, // Adjust the index based on your table structure
        ddate: ddate, // Adjust the index based on your table structure
        dtime: dtime,
        addlocation: addlocation, // Adjust the index based on your table structure
        dassets: dassets, // Adjust the index based on your table structure
        selectedValue: selectedValue, // Adjust the index based on your table structure
        status: status,
        totamt:totamt,
        ordertype:ordertype,
        branch:branch,
        dgoogle:dgoogle
    };

    followupdataToSave.push(rowData1);
    console.log(rowData1);
    // ==============================================
    // Combine the two arrays into a single object for the AJAX request
    var combinedData = {
        editid:editid,
        // staffallocationdataToSave:staffallocationdataToSave,
        supplierdataToSave: supplierdataToSave,
        paymentdataToSave: paymentdataToSave,
        followupdataToSave: followupdataToSave,
    };

    // Send data to the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update-paymentdetails.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Handle the response from the server if needed
                console.log("result: " + xhr.responseText);
                alert("Succesfully Updated Data.");
                window.location.href = 'orderslist.php';
            } else {
                // Handle errors if any
                console.error("Error saving data: " + xhr.status);
                alert("Error saving data. Please try again.");
            }
        }
    };

    xhr.send(JSON.stringify(combinedData));
}
// ******************** end data saving code****************










