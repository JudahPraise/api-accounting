export function successAlert(){

}

function alertScafolding(){
    var html = "";
    html += '<div class="alert alert-dismissible bg-light-'++' border border-'++' border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">';
    html += '<span class="svg-icon svg-icon-2hx svg-icon-danger me-3">';
    html += '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">';
    html += '<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>';
    html += '<rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>';
    html +='<rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>';
    html += "</svg>";
    html += "</span>";
    html += '<div class="d-flex flex-stack flex-grow-1 ">';
    html += '<div class=" fw-semibold">';
    html += '<h4 class="text-gray-900 fw-bold">'++'</h4>';
    html +='<div class="fs-6 text-gray-700 ">Updating address may affter to your <a href="#">Tax Location</a></div>';
    html += "</div>";
    html += "</div>";
    html += "</div>";
    return html;
}