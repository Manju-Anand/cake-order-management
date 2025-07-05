
   

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
    var selectBox1 = document.getElementById("relation").value;
    var selectBox2 = document.getElementById("rname").value;
    var selectBox3 = document.getElementById("rage").value;
    var selectBox4 = document.getElementById("rdob").value;
    // Check if both select boxes are selected
    // if (selectBox1.selectedIndex === -1 || selectBox2.selectedIndex === -1) {
    if (selectBox1 === "" || selectBox2 === "" || selectBox3 === ""|| selectBox4 === "") {
        alert("Please select values for the Relation,Name,Age & DOB.");
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
    var selectBox1 = document.getElementById("relation");
    cell2.innerHTML = selectBox1.options[selectBox1.selectedIndex].text;

    var cell3 = newRow.insertCell(2);
    var textBox1 = document.getElementById("rname");
    cell3.innerHTML = textBox1.value;
    // cell3.classList.add('qty');

     // Text Box 1
    var cell4 = newRow.insertCell(3);
    var textBox2 = document.getElementById("rage");
    cell4.innerHTML = textBox2.value;
    // cell4.classList.add('mrp');

    // Text Box 2
    var cell5 = newRow.insertCell(4);
    var textBox3 = document.getElementById("rdob");
    cell5.innerHTML = textBox3.value;

    
    // New cell with Edit and Delete buttons  ===========href='edit-supplier.php?edit=" + ++rowCounter + "'---onclick='javascript:confirmationDelete($(this));return false;
    var cell6 = newRow.insertCell(5);
    cell6.innerHTML = "<a class='btn btn-sm btn-primary edit-btn'  data-bs-target='#paymentmodal' data-bs-toggle='modal' title='Edit' style='color:white'>" +
        "<span class='fe fe-edit'> </span></a>&nbsp;&nbsp;" +
        "<a class='btn btn-sm btn-danger delete-btn'  id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'>" +
        "<span class='fe fe-trash-2'> </span></a>";

    var cell7 = newRow.insertCell(6);
    cell7.innerHTML = "New";
    // cell7.classList.add('hidden-cell');
// 
    var cell8 = newRow.insertCell(7);
    cell8.innerHTML = "";
    // cell8.classList.add('hidden-cell');

    // Clear input values after adding to the table
    textBox2.value = "";
    textBox1.value = "";
    textBox3.value = "";

    // Clear select box values
    selectBox1.selectedIndex = -1;

}


// Add a click event listener for the "Edit" buttons
$('body').on('click', '.edit-btn', function () {
   
    // Get the corresponding row
    var row = $(this).closest('tr');

    // Extract values from the row
    var pname = row.find('td:eq(1)').text(); // Replace 1 with the actual column index
    var pid = row.find('td:eq(2)').text();
    var qty = row.find('td:eq(3)').text();
    var mrp = row.find('td:eq(4)').text(); // Replace 3 with the actual column index


    var rowId = row.data('rowid'); // Assuming you have a data-rowid attribute on your row

    // Set values in the modal
    $('#modalrelation').val(pname).trigger('change');

    $('#modalname').val(pid);
    $('#modalage').val(qty);
    $('#modaldob').val(mrp);
 
   
    // Set the value of the new textbox
    $('#modalpayrowid').val(rowId);

    // Trigger the modal to display
    $('#paymentmodal').modal('show');
});




$('body').on('click', '.delete-btn', function () {
    // Get the corresponding row
    var row = $(this).closest('tr');

    // Extract the row data id
    // var rowId = row.data('rowid');
    var specificColumnData = row.find('td:nth-child(8)').text().trim();
    // alert (specificColumnData);
    // Confirmation dialog before deleting
    if (confirm("Are you sure you want to delete this row?")) {
        // row.remove();

        // updateRowNumbers();
         // Perform the AJAX request to delete the row from the server
         $.ajax({
            url: 'delete_customer_row.php', // Replace with the actual URL of your server-side script
            type: 'POST',
            data: { specificColumnData: specificColumnData },
            success: function(response) {
                // Assuming the server returns a success message
                // if (response.success == true) {
                    // Remove the row from the table
                    row.remove();
                    // Optionally, update the numbering in the first column of remaining rows
                    updateRowNumbers();
                    // alert('Successfully deleted the row: ');
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
$('#savepayChangesBtn').on('click', function () {
    // Get the values from the modal fields
    var modalrelation = $('#modalrelation').val();
    var modalname = $('#modalname').val();
  
    var modalage = $('#modalage').val();
    var modaldob = $('#modaldob').val();
    
    
    var pstatus= "Edited";
   
    // Get the selected row in the table (assuming it has an id, adjust as needed)
    var selectedRowId = $('#modalpayrowid').val(); // Update this to the actual input or method to get the row ID

    // Update the corresponding row in the table
    var selectedRow = $('#productTable tbody tr[data-rowid="' + selectedRowId + '"]');
    selectedRow.find('td:eq(1)').text(modalrelation); // Update with the correct column indices.
    selectedRow.find('td:eq(2)').text(modalname); // Update with the correct column indices.
    selectedRow.find('td:eq(3)').text(modalage); // Update with the correct column indices
    selectedRow.find('td:eq(4)').text(modaldob); // Update with the correct column indices
  
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
            prelation: cells[1].innerHTML, // Adjust the index based on your table structure
            pname: cells[2].innerHTML, // Adjust the index based on your table structure
            page: cells[3].innerHTML, // Adjust the index based on your table structure
            pdob: cells[4].innerHTML, // Adjust the index based on your table structure
            payStatus: cells[6].innerHTML, // Adjust the index based on your table structure
            precordid: cells[7].innerHTML,
            // Add more fields as needed
        };

        supplierdataToSave.push(rowData);
    }
    console.log(rowData);
    // *******************************

    // ==================== other details================
    var followupdataToSave = [];
    var custname = document.getElementById("customer").value;
    var cadd = document.getElementById("cadd").value;
    var cphoneno = document.getElementById("cphoneno").value;
    var cemail = document.getElementById("cemail").value;
    var landmark = document.getElementById("landmark").value;
    var status = document.getElementById("status").value;
    var cremarks = document.getElementById("cremarks").value;

    var cdob = document.getElementById("cdob").value;
    var canndate = document.getElementById("canndate").value;
  

   
    var rowData1 = {
        custname: custname, // Adjust the index based on your table structure
        cadd: cadd, // Adjust the index based on your table structure
        cphoneno: cphoneno, // Adjust the index based on your table structure
        cemail: cemail, // Adjust the index based on your table structure
        landmark: landmark,
        status: status, // Adjust the index based on your table structure
        cremarks: cremarks, // Adjust the index based on your table structure
        cdob: cdob, // Adjust the index based on your table structure
        canndate: canndate
       
    };

    followupdataToSave.push(rowData1);
    console.log(rowData1);
    // ==============================================
    // Combine the two arrays into a single object for the AJAX request
    var combinedData = {
        editid:editid,
        // correctorderid:correctorderid,
        // staffallocationdataToSave:staffallocationdataToSave,
        supplierdataToSave: supplierdataToSave,
        followupdataToSave: followupdataToSave,
    };

    // Send data to the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update-customerdetails.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Handle the response from the server if needed
                console.log("result: " + xhr.responseText);
                alert("Succesfully Saved Data.");
                // window.location.href = 'customerlist.php';
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










