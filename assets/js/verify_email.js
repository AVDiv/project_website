let pincode_input = document.getElementById('otp');
let resend_button = document.getElementById('resend');
let verify_button = document.getElementById('verify');
// Timers
let resend_min_tag = document.getElementById('mins');
let resend_sec_tag = document.getElementById('secs');
let resend_timer = parseInt(resend_min_tag.innerText)*60 + parseInt(resend_sec_tag.innerText);
let resend_timer_interval = setInterval(function(){
    resend_timer--;
    let mins = Math.floor(resend_timer/60);
    let secs = resend_timer%60;
    // verify button disabling logic
    resend_min_tag.innerText = '0'+mins;
    resend_sec_tag.innerText = ((secs<10)?'0'+secs:secs);
    if(resend_timer <= 0){
        resend_button.disabled = false;
        clearInterval(resend_timer_interval);
    }
}, 1000);

// verify button disabling logic
pincode_input.addEventListener('input', function(){
    verify_button.disabled = !(pincode_input.value.length === 6 && !isNaN(pincode_input.value));
});

function resendOtp(){
    if(!resend_button.disabled){
        const req = new XMLHttpRequest();
        req.onload = function(){
            // reload the page
            location.reload();
        }
        req.open('POST', resend_button.dataset.url);
        req.setRequestHeader('Content-Type', "application/x-www-form-urlencoded");
        req.send("email="+resend_button.dataset.email);
    }
}