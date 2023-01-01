
// Get the input element
const input = document.getElementById('price');

// Add an event listener for the input event
input.addEventListener('input', function() {
  // Get the input value
  let value = input.value;

  // Remove any non-numeric characters
  value = value.replace(/[^\d]/g, '');

  // Format the value as a currency
  value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');

  // Update the input value
  input.value = 'Rs.' + value;
});
