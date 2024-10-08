// Function to show progress bar
function showLoaderAndProgress() {
    // Reset progress bar
    document.getElementById("progress-bar").style.width = "0%";
    
    // Simulate page loading with progress bar
    let progress = 0;
    function updateProgressBar() {
        if (progress < 100) {
            progress += 10;
            document.getElementById("progress-bar").style.width = progress + "%";
            setTimeout(updateProgressBar, 200);
        }
    }
    updateProgressBar();
}

// Initialize progress bar when the DOM is ready
document.addEventListener("DOMContentLoaded", function() {
    // Create progress bar element if not already present
    if (!document.getElementById("progress-bar")) {
        const progressBar = document.createElement("div");
        progressBar.id = "progress-bar";
        document.body.appendChild(progressBar);
    }

    // Event listener for popstate (back/forward navigation)
    window.addEventListener("popstate", function() {
        showLoaderAndProgress();
        setTimeout(function() {
            // Reload the current page to simulate the navigation
            window.location.reload();
        }, 2000); // Simulated delay to demonstrate the loading process
    });
});
