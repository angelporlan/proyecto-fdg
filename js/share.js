document.addEventListener('DOMContentLoaded', setup);

function setup(_) {
    setAlertsInfo();
}

function setAlertsInfo() {
    document.querySelector('.user-sing').addEventListener('click', function() {
        document.querySelector('.user-sing').remove();
    })
}