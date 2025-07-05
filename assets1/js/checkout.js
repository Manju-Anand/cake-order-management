document.getElementById("personal-details-trigger").onclick= ()=>{
    document.getElementById("confirmed-tab").click()
}

document.getElementById("payment-trigger").onclick= ()=>{
    document.getElementById("shipped-tab").click()
}

document.getElementById("back-shipping-trigger").onclick= ()=>{
    document.getElementById("order-tab").click()
}

document.getElementById("back-personal-trigger").onclick= ()=>{
    document.getElementById("confirmed-tab").click()
}

document.getElementById("continue-payment-trigger").onclick= ()=>{
    document.getElementById("delivered-tab").click()
}

document.getElementById("back-payment-trigger").onclick= ()=>{
    document.getElementById("shipped-tab").click()
}

document.getElementById("continue-confirm-trigger").onclick= ()=>{
    document.getElementById("finished-tab").click()
}


 /* multi select with remove button */
 const multipleCancelButton = new Choices(
   '#choices-multiple-remove-button',
   {
     allowHTML: true,
     removeItemButton: true,
   }
 );

 /* multi select with remove button */
 const multipleCancelButton2 = new Choices(
    '#choices-multiple-remove-button2',
    {
      allowHTML: true,
      removeItemButton: true,
    }
  );