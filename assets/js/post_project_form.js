
// Get the budget element
const budget = document.getElementById('price');
// Add an event listener for the budget event
budget.addEventListener('input', function() {
  // Get the budget value
  let value = budget.value;

  // Remove any non-numeric characters
  value = value.replace(/[^\d]/g, '');
  if (value.slice(0, 3)==='Rs.'){
    value = value.slice(3);
  }
  if(value.length > 7){
    value = value.slice(0,7);
  } else if(value.length === 7){
    if (parseInt(value)>1000000){
        value = value.slice(0,6);
    }
  }
  // Format the value as a currency
  value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');

  // Update the budget value
  budget.value = 'Rs.' + value;
});