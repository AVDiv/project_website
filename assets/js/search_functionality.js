// Intialization
const main_container = document.getElementById('main-container');
const search_input = document.getElementById('search-input');
const search_mode = document.getElementById('search-mode');
const user_result_holder = document.getElementById('user-result-holder');
const project_result_holder = document.getElementById('project-result-holder');

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
    // Do a search if query is set
    if(search_input.value){
        search_request(search_input.value, search_mode.value, search_page);
    }
}
// Search enter event
search_input.addEventListener('keyup', function(event){
    if(event.keyCode === 13){
        search_request(search_input.value, search_mode.value, search_page);
    }
});

function search_request(query, mode, page){
    main_container.classList.add('searched');
    search_api_call(query, mode, page);
    end_animation();
}
function search_api_call(query, mode, page){
    // Do a search
    const req = new XMLHttpRequest();
    req.onload = function(){
        // Fetch the results
        results = JSON.parse(req.responseText);
        // Display the results
        if (mode === '1') {
            // Print project result components with respective values on the result holder
            for (let i = 0; i < results['length']; i++) {
                project_result_holder.insertAdjacentHTML('beforeend', `<div class="row project-result" style="padding: 30px 20px;box-shadow: 0px 5px 10px rgba(0,0,0,0.1);backdrop-filter: opacity(0.44) blur(30px);border-radius: 25px;border: 1px solid rgb(237,237,237);margin-bottom: 25px;">
                <div class="col" id="project-result-info-1" style="padding-left: 40px;position: relative;border-left: 3px solid rgb(0,120,241) ;">
                    <div style="margin-bottom: 15px;">
                        <h4 style="font-weight: bold;margin-bottom: 0px;">${results['data'][i]['Title']}</h4>
                        <h5 style="position: relative;font-weight: bold;color: rgb(183,183,183);">by @${results['data'][i]['Client']}</h5>
                    </div>
                    <p style="margin-bottom: 0px;">${results['data'][i]['Description']}</p>
                </div>
                <div class="col-3 d-flex justify-content-end align-items-center col-sm-5">
                    <h5 class="price" style="color: rgb(0,133,255);font-weight: bold;">${results['data'][i]['Budget']}</h5>
                </div>
            </div>`);
            }
            // Display result holder
            project_result_holder.classList.remove('d-none');
            project_result_holder.classList.add('d-block');
        }
    }
    req.open('GET', search_input.dataset.url+'?query='+query+'&mode='+mode+'&page='+page);
    req.setRequestHeader('Content-Type', "application/x-www-form-urlencoded");
    req.send();
}
function end_animation(){
    for (let i = 1; i < 6; i+=0.01) {
        setTimeout(function(){
            for (let j = 0; j < user_result_holder.childElementCount; j++) {
                user_result_holder.children[j].children[0].style.borderWidth = i+'px';
            }
        }, i*15);
    }
}