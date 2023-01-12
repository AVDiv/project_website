const assignee_container = document.getElementById('assignee-holder');
var see_more_btn = document.getElementById('see-more-btn');
var next_set_no = 1;
var no_assignees_container = document.getElementById('no-assignees-container');
window.onload = function() {
    import_items(next_set_no);
}

function import_items(set_no){
    const req = new XMLHttpRequest();
    req.onload = function(){
    if(req.status === 200){
            let response = JSON.parse(req.responseText);
            response.data.forEach((item)=>{
                assignee_container.insertAdjacentHTML('beforeend', `
                    <div class="row" style="padding: 30px 20px;border-radius: 15px;border: 1px solid rgb(220,220,220);box-shadow: 0px 5px 10px rgba(0,0,0,0.1);margin-bottom: 20px;">
                        <div class="col">
                            <div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center"><img width="100" height="80" style="width: 50px;height: 50px;border-radius: 100px;border: 1px solid rgb(232,232,232) ;">
                                        <div class="d-flex flex-column justify-content-center" style="margin-left: 15px;">
                                            <h5 style="margin-bottom: 3px;font-weight: bold;">${item.Name}</h5>
                                            <h6>@${item.Username}</h6>
                                        </div>
                                    </div>
                                    <div style="height: 100%;"><button class="btn btn-primary" type="button" name="assignee" value="${item.Username}">Assign</button></div>
                                </div>
                                <p style="margin-top: 10px;">${item.Proposal}</p>
                            </div>
                        </div>
                    </div>
                `);
            });
            if(response.more_sets_available === false){
                see_more_btn.remove();
                if (next_set_no==1){

                }
            } else {
                next_set_no++;
            }
        }
    }
    req.open('GET', proposal_item.dataset.url+'?set='+set_no, true);
    req.setRequestHeader('Content-Type', "application/x-www-form-urlencoded");
    req.send();
}