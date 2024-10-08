document.addEventListener('DOMContentLoaded', loadTopics);

document.getElementById('topic-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const topicName = document.getElementById('topic-name').value;
    const topicLink = document.getElementById('topic-link').value;
    const topicCategory = document.getElementById('topic-category').value;

    const topic = {
        name: topicName,
        link: topicLink,
        category: topicCategory
    };

    addTopicToCategory(topic);
    saveTopics();
    document.getElementById('topic-form').reset();
    document.getElementById('add-topic-form').style.display = 'none';
});

function showAddTopicForm() {
    document.getElementById('add-topic-form').style.display = 'block';
}

function removeTopic(button) {
    const topicDiv = button.parentElement;
    topicDiv.remove();
    saveTopics();
}

function addTopicToCategory(topic) {
    const newTopic = document.createElement('div');
    newTopic.classList.add('det');
    newTopic.innerHTML = `
        <a href="${topic.link}" target="_blank">${topic.name}</a>
        <button class="delete-btn" onclick="removeTopic(this)">Delete</button>
    `;

    document.getElementById(topic.category).appendChild(newTopic);
}

function saveTopics() {
    const categories = ['cbox1', 'cbox2', 'cbox3'];
    const topics = [];

    categories.forEach(categoryId => {
        const category = document.getElementById(categoryId);
        const categoryTopics = Array.from(category.querySelectorAll('.det')).map(topicDiv => {
            const link = topicDiv.querySelector('a').href;
            const name = topicDiv.querySelector('a').textContent;
            return { name, link, category: categoryId };
        });

        topics.push(...categoryTopics);
    });

    localStorage.setItem('topics', JSON.stringify(topics));
}

function loadTopics() {
    const topics = JSON.parse(localStorage.getItem('topics')) || [];

    topics.forEach(topic => {
        addTopicToCategory(topic);
    });
}
