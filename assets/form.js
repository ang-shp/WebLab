'use strict';

document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('feedbackForm');
  const status = document.getElementById('formStatus');

  if (!form || !status) return;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    status.textContent = 'Надсилання...';

    const formData = new FormData(form);

    try {
      const response = await fetch('submit_form.php', {
        method: 'POST',
        body: formData
      });

      const result = await response.text();
      status.textContent = result;
      status.style.color = '#b8f7d4';
      status.style.borderColor = 'rgba(80, 220, 160, 0.25)';
      status.style.background = 'rgba(80, 220, 160, 0.08)';

      if (response.ok) {
        form.reset();
      }
    } catch (error) {
      status.textContent = 'Помилка при відправці форми.';
      status.style.color = '#ffb4b4';
      status.style.borderColor = 'rgba(255, 90, 90, 0.25)';
      status.style.background = 'rgba(255, 90, 90, 0.08)';
    }
  });
});