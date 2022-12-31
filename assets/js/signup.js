const phoneNumber = document.getElementById('phone-number');

phoneNumber.addEventListener('input', event => {
    const value = event.target.value;
     // Add formatting
    event.target.value = value
        .replace(/\D/g, '') // Remove non-numeric characters
        .replace(/^(\d{1,3})(\d{3})(\d{3})(\d{4})$/, '+$1 ($2) $3 $4');
});
