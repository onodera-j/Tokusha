document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.tab-item').forEach(tab => {
    tab.addEventListener('click', () => {
      const category = tab.dataset.category;

      document.querySelectorAll('.tab-item')
        .forEach(t => t.classList.remove('active'));
      tab.classList.add('active');

      filter(category);
    });
  });
});

function filter(category) {
  document.querySelectorAll('.table-row').forEach(row => {
    row.style.display =
      row.dataset.category === category ? '' : 'none';
  });
}
