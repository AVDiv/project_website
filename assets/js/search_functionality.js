// Intialization
const main_container = document.getElementById('main-container');
const search_input = document.getElementById('search-input');
const search_mode = document.getElementById('search-mode');
const pre_loader = document.getElementById('pre-loader-holder');
const user_result_holder = document.getElementById('user-result-holder');
const project_result_holder = document.getElementById('project-result-holder');
const result_counter = document.getElementById('result-counter');

let search_page = '1';
let results = null;
// Onload check function
window.onload = function() {
    // Setting search mode from parameters
    if(search_input.dataset.mode === '1' || search_input.dataset.mode === '2'){
        search_mode.value = search_input.dataset.mode;
    }
    // Setting search query from parameters
    if(search_input.dataset.page){
        search_page = search_input.dataset.page;
    }
    search_request(search_input.value, search_mode.value, search_page);
}
// Search enter event
search_input.addEventListener('keyup', function(event){
    if(event.keyCode === 13){
        search_request(search_input.value, search_mode.value, search_page);
    }
});

function search_request(query, mode, page){
    main_container.classList.add('searched');
    // Display preloader
    pre_loader.classList.remove('d-none');
    pre_loader.classList.add('d-flex');
    // Hide the result holders
    project_result_holder.classList.remove('d-block');
    project_result_holder.classList.add('d-none');
    user_result_holder.classList.remove('d-block');
    user_result_holder.classList.add('d-none');
    // Clear the result holders
    result_counter.innerText = ""; // Clear result counter
    search_api_call(query, mode, page);
}
function search_api_call(query, mode, page){
    // Do a search
    const req = new XMLHttpRequest();
    req.onload = function(){
        // Fetch the results
        results = JSON.parse(req.responseText);
        // Display result counter
        result_counter.innerText = `Showing ${results['length']-(10*(parseInt(page)-1))<10?results['length']:"10"} of ${results.length} results`;
        // Display the results
        if (mode === '1') {
            // Print project result components with respective values on the result holder
            for (let i = 0; i < results['length']; i++) {
                project_result_holder.insertAdjacentHTML('beforeend', `<div class="row project-result" style="padding: 30px 20px;box-shadow: 0px 5px 10px rgba(0,0,0,0.1);backdrop-filter: opacity(0.44) blur(30px);border-radius: 25px;border: 1px solid rgb(237,237,237);margin-bottom: 25px;">
                <div class="col" style="padding-left: 40px;position: relative;border-width: 0px;border-color: rgb(0,128,255);border-left-style: solid;">
                    <div style="margin-bottom: 15px;">
                        <h4 style="font-weight: bold;margin-bottom: 0px;"><a style="text-decoration: none;font: inherit;color: var(--color-dark-blue);" href="${project_result_holder.dataset.projecturl+"?id="+results['data'][i]['Shortlink']}">${results['data'][i]['Title']}</a></h4>
                        <h5 style="position: relative;font-weight: bold;color: rgb(183,183,183);">by <a style="text-decoration: none;font: inherit;color: inherit;" href="${project_result_holder.dataset.userurl+"?u="+results['data'][i]['Client']}">@${results['data'][i]['Client']}</a></h5>
                    </div>
                    <p style="margin-bottom: 0px;">${results['data'][i]['Description']}</p>
                </div>
                <div class="col-3 d-flex justify-content-end align-items-center col-sm-5">
                    <h5 class="price" style="color: rgb(0,133,255);font-weight: bold;">${"Rs."+results['data'][i]['Budget'].replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')}</h5>
                </div>
            </div>`);
            }
            // Show the result holders
            project_result_holder.classList.remove('d-none');
            project_result_holder.classList.add('d-block');
        } else if (mode === '2') {

            // Show the result holders
            user_result_holder.classList.remove('d-none');
            user_result_holder.classList.add('d-block');
        }
        // Hide the preloader
        pre_loader.classList.remove('d-flex');
        pre_loader.classList.add('d-none');
        // Animate the end of the search
        end_animation();
    }
    req.open('GET', search_input.dataset.url+'?query='+query+'&mode='+mode+'&page='+page);
    req.setRequestHeader('Content-Type', "application/x-www-form-urlencoded");
    req.send();
}
function end_animation(){
    // Animate the end of the search
    if (search_mode.value === '1') {
        // Project mode
        for (let i = 0; i <= 5; i += 0.01) {
            console.log("Project mode");
            setTimeout(function () {
                for (let j = 0; j < project_result_holder.childElementCount; j++) {
                    project_result_holder.children[j].children[0].style.borderWidth = i + 'px';
                }
            }, i * 25);
        }
    } else if (search_mode.value === '2') {
        // User mode
        for (let i = 0; i <= 5; i += 0.01) {
            setTimeout(function () {
                for (let j = 0; j < user_result_holder.childElementCount; j++) {
                    user_result_holder.children[j].children[0].style.borderWidth = i + 'px';
                }
            }, i * 25);
        }
    }
}