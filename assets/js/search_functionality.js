// Intialization
const main_container = document.getElementById('main-container');
const search_input = document.getElementById('search-input');
const search_mode = document.getElementById('search-mode');
const user_result_holder = document.getElementById('user-result-holder');
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
    end_animation();
}
function search_api_call(query, mode, page){
    // Do a search
    const req = new XMLHttpRequest();
    req.onload = function(){
        // Fetch the results
        results = JSON.parse(req.responseText);
        return results;
    }
    req.open('GET', search_input.dataset.url);
    req.setRequestHeader('Content-Type', "application/x-www-form-urlencoded");
    req.send("query="+query+"&mode="+mode+"&page="+page);
}
function end_animation(){
    for (let i = 1; i < 6; i++) {
        setTimeout(function(){
            for (let j = 0; j < user_result_holder.childElementCount; j++) {
                user_result_holder.children[j].children[0].style.borderWidth = i+'px';
            }
        }, i*25);
    }
}