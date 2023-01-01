const input_profile_image = document.getElementById('image-input-profile');

// Profile picture edit
input_profile_image.addEventListener('change', () => {
    const file = input_profile_image.files[0];
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => {
        const imageDataUrl = reader.result;
        const profile_img_preview = document.getElementById('profile-picture');
        // img.src = imageDataUrl[0];
        // img.src = imageDataUrl;
        // profile_img_preview.style.backgroundImage = `url(${imageDataUrl[0]})`;
        profile_img_preview.style.backgroundImage = `url(${imageDataUrl})`;
    };

});
// Common Add item button animations
// Portfolio
let add_item_button_portfolio = document.getElementById('add-item-button-portfolio');
let items_portfolio =  "";
let items_portfolio_element = `    
    <div class="p-item portfolio-item" style="transition: all 0.5s ease-out;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
        <button class="btn btn-primary d-flex d-xxl-flex justify-content-center align-items-center remove-item-portfolio" type="button" style="position: absolute;border-radius: 100px;padding: 4px 4px;top: -10px;right: -10px;background: #E63946;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);z-index: 10;border-style: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 14px;pointer-events: none;">
                <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path>
            </svg></button><img src="" alt="" style="width: 100%;height: 75%;">
        <div class="d-flex justify-content-center align-items-center p-text-container">
            <p class="d-xxl-flex" style="margin-bottom:0;height: auto;color: #71a0e6;font-size: 14px;">Portfolio Item</p>
        </div>
    </div>
`;
let remove_item_portfolio = Array();
add_item_button_portfolio.addEventListener('click', () => {
    const default_width = add_item_button_portfolio.style.width;
    const default_height = add_item_button_portfolio.style.height;
    const default_padding = add_item_button_portfolio.style.padding;
    const default_borderWidth = add_item_button_portfolio.style.borderWidth;
    const default_opacity = add_item_button_portfolio.style.opacity;
    const default_fontSize = add_item_button_portfolio.style.fontSize;
    add_item_button_portfolio.style.width = '0px';
    add_item_button_portfolio.style.height = '0px';
    add_item_button_portfolio.style.padding = '0px';
    add_item_button_portfolio.style.borderWidth = '0px';
    add_item_button_portfolio.style.opacity = '0';
    add_item_button_portfolio.style.fontSize = '0px';
    add_item_button_portfolio.insertAdjacentHTML('beforebegin', items_portfolio_element);
    items_portfolio = document.querySelectorAll('.portfolio-item');
    remove_item_portfolio = document.querySelectorAll('.remove-item-portfolio');
    let last_item_portfolio = items_portfolio[items_portfolio.length - 1];
    const default_width_item = last_item_portfolio.style.width;
    const default_height_item = last_item_portfolio.style.height;
    const default_padding_item = last_item_portfolio.style.padding;
    const default_borderWidth_item = last_item_portfolio.style.borderWidth;
    const default_opacity_item = last_item_portfolio.style.opacity;
    const default_fontSize_item = last_item_portfolio.style.fontSize;
    last_item_portfolio.style.width = '0px';
    last_item_portfolio.style.height = '0px';
    last_item_portfolio.style.padding = '0px';
    last_item_portfolio.style.borderWidth = '0px';
    last_item_portfolio.style.opacity = '0';
    last_item_portfolio.style.fontSize = '0';
    setTimeout(() => {
        if(items_portfolio.length > 8){
            add_item_button_portfolio.classList.remove('d-flex');
            add_item_button_portfolio.classList.add('d-none');
        }
        add_item_button_portfolio.style.width = default_width;
        add_item_button_portfolio.style.height = default_height;
        add_item_button_portfolio.style.padding = default_padding;
        add_item_button_portfolio.style.borderWidth = default_borderWidth;
        add_item_button_portfolio.style.opacity = default_opacity;
        last_item_portfolio.style.width = default_width_item;
        last_item_portfolio.style.height = default_height_item;
        last_item_portfolio.style.padding = default_padding_item;
        last_item_portfolio.style.borderWidth = default_borderWidth_item;
        last_item_portfolio.style.opacity = default_opacity_item;
    }, 1000);
});
// Experience
let add_item_button_experience = document.getElementById('add-item-button-experience');
let items_experience =  "";
let items_experience_element = `
    <div class="d-flex align-items-center e-item experience-item" style="transition: all 0.5s ease-out;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
        <button class="btn btn-primary d-flex justify-content-center align-items-center remove-item-experience" type="button" style="position: absolute;border-radius: 100px;padding: 4px 4px;top: -10px;right: -10px;background: #E63946;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);z-index: 10;border-style: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor" style="pointer-events: none;font-size: 14px;">
                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path>
            </svg></button>
        <div class="e-txt-container" style="margin-left: 45px;">
            <div class="e-txt-heading" style="font-size: 18px;margin-bottom: 3px;">
                <p class="e-txt-heading-item" style="margin-left:0;">Sample Corp.</p>
                <p class="e-txt-heading-item" style="color: #cdd7e1;"><strong>•</strong></p>
                <p class="e-txt-heading-item" style="color: #71a0e6;">Position</p>
            </div>
            <p style="margin-bottom:0;margin-left:0;font-size: 15px;color: #cdd7e1;">From 2XXX to 2XXX</p>
        </div>
    </div>
`;
let remove_item_experience = Array();
add_item_button_experience.addEventListener('click', () => {
    const default_width = add_item_button_experience.style.width;
    const default_height = add_item_button_experience.style.height;
    const default_padding = add_item_button_experience.style.padding;
    const default_borderWidth = add_item_button_experience.style.borderWidth;
    const default_opacity = add_item_button_experience.style.opacity;
    const default_fontSize = add_item_button_experience.style.fontSize;
    add_item_button_experience.style.width = '0px';
    add_item_button_experience.style.height = '0px';
    add_item_button_experience.style.padding = '0px';
    add_item_button_experience.style.borderWidth = '0px';
    add_item_button_experience.style.opacity = '0';
    add_item_button_experience.style.fontSize = '0px';
    add_item_button_experience.insertAdjacentHTML('beforebegin', items_experience_element);
    items_experience = document.querySelectorAll('.experience-item');
    remove_item_experience = document.querySelectorAll('.remove-item-experience');
    let last_item_experience = items_experience[items_experience.length - 1];
    const default_width_item = last_item_experience.style.width;
    const default_height_item = last_item_experience.style.height;
    const default_padding_item = last_item_experience.style.padding;
    const default_borderWidth_item = last_item_experience.style.borderWidth;
    const default_opacity_item = last_item_experience.style.opacity;
    const default_fontSize_item = last_item_experience.style.fontSize;
    last_item_experience.style.width = '0px';
    last_item_experience.style.height = '0px';
    last_item_experience.style.padding = '0px';
    last_item_experience.style.borderWidth = '0px';
    last_item_experience.style.opacity = '0';
    last_item_experience.style.fontSize = '0';
    setTimeout(() => {
        if(items_experience.length > 6){
            add_item_button_experience.classList.remove('d-flex');
            add_item_button_experience.classList.add('d-none');
        }
        add_item_button_experience.style.width = default_width;
        add_item_button_experience.style.height = default_height;
        add_item_button_experience.style.padding = default_padding;
        add_item_button_experience.style.borderWidth = default_borderWidth;
        add_item_button_experience.style.opacity = default_opacity;
        last_item_experience.style.width = default_width_item;
        last_item_experience.style.height = default_height_item;
        last_item_experience.style.padding = default_padding_item;
        last_item_experience.style.borderWidth = default_borderWidth_item;
        last_item_experience.style.opacity = default_opacity_item;
    }, 1000);
});
// Education
let add_item_button_education = document.getElementById('add-item-button-education');
let items_education =  "";
let items_education_element = ` 
    <div class="d-flex align-items-center ed-item education-item" style="transition: all 0.5s ease-out;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);position: relative;">
        <div class="e-txt-container" style="margin-left: 45px;">
            <div class="e-txt-heading" style="font-size: 18px;margin-bottom: 3px;">
                <p class="e-txt-heading-item" style="margin-left:0;">BSc. in Mokak hari ekak</p>
                <p class="e-txt-heading-item" style="color: #cdd7e1;"><strong>•</strong></p>
                <p class="e-txt-heading-item" style="color: #cdd7e1;">4 Years</p>
            </div>
            <p style="margin-bottom: 3px;margin-left:0;font-size: 15px;color: #71a0e6;">NSBM Green University - Sri Lanka</p>
            <p style="margin-bottom:0;margin-left:0;font-size: 15px;color: #71a0e6;">2XXX - 2XXX</p>
        </div>
        <button class="btn btn-primary d-flex justify-content-center align-items-center remove-item-education" type="button" style="position: absolute;border-radius: 100px;padding: 4px 4px;top: -10px;right: -10px;background: #E63946;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);z-index: 10;border-style: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor" style="pointer-events: none;font-size: 14px;">
            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
            <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path>
        </svg></button>
    </div>
`;
let remove_item_education = Array();
add_item_button_education.addEventListener('click', () => {
    const default_width = add_item_button_education.style.width;
    const default_height = add_item_button_education.style.height;
    const default_padding = add_item_button_education.style.padding;
    const default_borderWidth = add_item_button_education.style.borderWidth;
    const default_opacity = add_item_button_education.style.opacity;
    const default_fontSize = add_item_button_education.style.fontSize;
    add_item_button_education.style.width = '0px';
    add_item_button_education.style.height = '0px';
    add_item_button_education.style.padding = '0px';
    add_item_button_education.style.borderWidth = '0px';
    add_item_button_education.style.opacity = '0';
    add_item_button_education.style.fontSize = '0px';
    add_item_button_education.insertAdjacentHTML('beforebegin', items_education_element);
    items_education = document.querySelectorAll('.education-item');
    remove_item_education = document.querySelectorAll('.remove-item-education');
    let last_item_education = items_education[items_education.length - 1];
    const default_width_item = last_item_education.style.width;
    const default_height_item = last_item_education.style.height;
    const default_padding_item = last_item_education.style.padding;
    const default_borderWidth_item = last_item_education.style.borderWidth;
    const default_opacity_item = last_item_education.style.opacity;
    const default_fontSize_item = last_item_education.style.fontSize;
    last_item_education.style.width = '0px';
    last_item_education.style.height = '0px';
    last_item_education.style.padding = '0px';
    last_item_education.style.borderWidth = '0px';
    last_item_education.style.opacity = '0';
    last_item_education.style.fontSize = '0';
    setTimeout(() => {
        if(items_education.length > 6){
            add_item_button_education.classList.remove('d-flex');
            add_item_button_education.classList.add('d-none');
        }
        add_item_button_education.style.width = default_width;
        add_item_button_education.style.height = default_height;
        add_item_button_education.style.padding = default_padding;
        add_item_button_education.style.borderWidth = default_borderWidth;
        add_item_button_education.style.opacity = default_opacity;
        last_item_education.style.width = default_width_item;
        last_item_education.style.height = default_height_item;
        last_item_education.style.padding = default_padding_item;
        last_item_education.style.borderWidth = default_borderWidth_item;
        last_item_education.style.opacity = default_opacity_item;
    }, 1000);
});
// Common document events
document.addEventListener('click', event => {
    for (let i = 0; i < remove_item_portfolio.length; i++) {
        if (event.target === remove_item_portfolio[i]) {
            items_portfolio[i].style.width = '0px';
            items_portfolio[i].style.height = '0px';
            items_portfolio[i].style.padding = '0px';
            items_portfolio[i].style.borderWidth = '0px';
            items_portfolio[i].style.opacity = '0';
            items_portfolio[i].style.fontSize = '0';
            add_item_button_portfolio.classList.remove('d-none');
            add_item_button_portfolio.classList.add('d-flex');
            setTimeout(() => {
                items_portfolio[i].remove();
            }, 600);
        }
    }
    for (let i = 0; i < remove_item_experience.length; i++) {
        if (event.target === remove_item_experience[i]) {
            items_experience[i].style.width = '0px';
            items_experience[i].style.height = '0px';
            items_experience[i].style.padding = '0px';
            items_experience[i].style.borderWidth = '0px';
            items_experience[i].style.opacity = '0';
            items_experience[i].style.fontSize = '0';
            add_item_button_experience.classList.remove('d-none');
            add_item_button_experience.classList.add('d-flex');
            setTimeout(() => {
                items_experience[i].remove();
            }, 600);
        }
    }
    for (let i = 0; i < remove_item_education.length; i++) {
        if (event.target === remove_item_education[i]) {
            items_education[i].style.width = '0px';
            items_education[i].style.height = '0px';
            items_education[i].style.padding = '0px';
            items_education[i].style.borderWidth = '0px';
            items_education[i].style.opacity = '0';
            items_education[i].style.fontSize = '0';
            add_item_button_education.classList.remove('d-none');
            add_item_button_education.classList.add('d-flex');
            setTimeout(() => {
                items_education[i].remove();
            }, 600);
        }
    }
});

