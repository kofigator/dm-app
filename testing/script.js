const searchBox = document.querySelector('#search_term');
const resultsBox = document.createElement('div');
resultsBox.classList.add('results');

searchBox.addEventListener('#search_term', () => {
  const searchTerm = searchBox.value.trim();
  if (searchTerm.length < 2) {
    resultsBox.innerHTML = '';
    return;
  }
  fetch(`/search_api.php?search_term=${encodeURIComponent(searchTerm)}`)
    .then(response => response.json())
    .then(data => {
      const resultsHTML = data.map(item => {
        return `<div class="result">
                  <span class="name">${item.name}</span>
                  <span class="unit_price">${item.unit_price}</span>
                </div>`;
      }).join('');
      resultsBox.innerHTML = resultsHTML;
    });
});

searchBox.insertAdjacentElement('afterend', resultsBox);
