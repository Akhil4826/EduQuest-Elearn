async function search() {
    const apiKey = '';
    const searchEngineId = '';
    const language = document.getElementById('language').value;
    const query = document.getElementById('searchQuery').value;
    if (!language) {
        alert('Please select a language.');
        return;
    }
    const refinedQuery = `${language} ${query}`;
    const url = `https://www.googleapis.com/customsearch/v1?key=${apiKey}&cx=${searchEngineId}&q=${encodeURIComponent(refinedQuery)}`;

    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = '<div class="spinner"></div>';

    const response = await fetch(url);
    const data = await response.json();

    setTimeout(() => {
        displayResults(data.items);
    }, 2000);
}

function displayResults(items) {
    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = '';

    if (items) {
        items.slice(0, 10).forEach((item, index) => {
            const linkElement = document.createElement('a');
            linkElement.href = item.link;
            linkElement.target = '_blank';
            linkElement.rel = 'noopener noreferrer';
            linkElement.textContent = `Link ${index + 1}: ${item.title}`;
            resultsDiv.appendChild(linkElement);
            resultsDiv.appendChild(document.createElement('br'));
            resultsDiv.appendChild(document.createElement('br'));
            resultsDiv.appendChild(document.createElement('hr'));
        });
    } else {
        resultsDiv.innerHTML = '<p>No results found.</p>';
    }
}



























/*async function search() {
    const apiKey = '';
    const searchEngineId = '';
    const query = document.getElementById('searchQuery').value;
    const url = `https://www.googleapis.com/customsearch/v1?key=${apiKey}&cx=${searchEngineId}&q=${encodeURIComponent(query)}`;

    const response = await fetch(url);
    const data = await response.json();

    displayResults(data.items);
}

function displayResults(items) {
    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = '';

    if (items) {
        items.slice(0, 10).forEach((item, index) => {
            const linkElement = document.createElement('a');
            linkElement.href = item.link;
            linkElement.target = '_blank'; // Added this line
            linkElement.rel = 'noopener noreferrer'; // Added this line to improve security
            linkElement.textContent = `Link ${index + 1}: ${item.title}`;
            resultsDiv.appendChild(linkElement);
            resultsDiv.appendChild(document.createElement('br'));
            resultsDiv.appendChild(document.createElement('br'));
            resultsDiv.appendChild(document.createElement('hr'));
        });
    } else {
        resultsDiv.innerHTML = '<p>No results found.</p>';
    }
}*/
















/*async function search() {
    const apiKey = 'AIzaSyCW3xCE8dlmVdvNjUH9qwUTREZ_Ibf8sqI';
    const searchEngineId = '1405839ff6ad04557';
    const query = document.getElementById('searchQuery').value;
    const url = `https://www.googleapis.com/customsearch/v1?key=${apiKey}&cx=${searchEngineId}&q=${encodeURIComponent(query)}`;

    const response = await fetch(url);
    const data = await response.json();

    displayResults(data.items);
}

function displayResults(items) {
    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = '';

    items.slice(0, 6).forEach((item, index) => {
        const linkElement = document.createElement('a');
        linkElement.href = item.link;
        linkElement.textContent = `Link ${index + 1}: ${item.title}`;
        resultsDiv.appendChild(linkElement);
        resultsDiv.appendChild(document.createElement('br'));
    });
}*/
