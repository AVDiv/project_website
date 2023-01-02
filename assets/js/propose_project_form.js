
// Get the input element
const budget = document.getElementById('budget');

// Add an event listener for the input event
budget.addEventListener('input', function() {
    // Get the input value
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

    // Update the input value
    budget.value = 'Rs.' + value;
});
