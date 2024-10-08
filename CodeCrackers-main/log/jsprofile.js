const pythonProgress = document.getElementById("python-progress");
const htmlProgress = document.getElementById("html-progress");
const cssProgress = document.getElementById("css-progress");
const javascriptProgress = document.getElementById("javascript-progress");
const sqlProgress = document.getElementById("sql-progress");
const phpProgress = document.getElementById("php-progress");

animateProgressBar(pythonProgress, 75);
animateProgressBar(htmlProgress, 50);
animateProgressBar(cssProgress, 25);
animateProgressBar(javascriptProgress, 10);
animateProgressBar(sqlProgress, 5);
animateProgressBar(phpProgress, 0);

function animateProgressBar(progressBar, targetWidth) {
  let currentWidth = 0;
  const intervalId = setInterval(() => {
    if (currentWidth >= targetWidth) {
      clearInterval(intervalId);
    } else {
      currentWidth++;
      progressBar.style.width = currentWidth + "%";
      progressBar.nextElementSibling.innerText = currentWidth + "%";
    }
  }, 10);
}

