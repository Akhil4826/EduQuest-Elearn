$(document).ready(function() {
    var modal = document.getElementById("profile-modal");
    var closeBtn = document.getElementsByClassName("close")[0];

    if (closeBtn) {
        closeBtn.onclick = function() {
            modal.style.display = "none";
        };
    } else {
        console.warn("Close button not found");
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});
