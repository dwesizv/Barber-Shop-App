const aDestroys = document.querySelectorAll('.link-destroy');
const form = document.getElementById('form-delete');
const logoutLink = document.getElementById('logout-link');

logoutLink.addEventListener('click', () => {
  document.getElementById('logout-form').submit();
});

const destroyModal = document.getElementById('destroyModal');
if(destroyModal) {
  destroyModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const peinado = button.dataset.peinado; //getAttribute('data-peinado');
      const href = button.dataset.href;
      form.action = href;
      destroyModalContent.textContent = `¿Seguro que quieres eliminar el peinado: ${peinado}?`;
  });

  aDestroys.forEach(item => {
      item.addEventListener('click', () => {
          console.log('a href clicked:', item.dataset.href);
          if(confirm('¿Seguro que quieres borrar el peinado ' + item.dataset.peinado + '?')) {
              form.action = item.dataset.href;
              form.submit();
          }
      });
  });
}

/*document.addEventListener('click', event => {
  if (event.target.classList.contains('link-destroy')) {
    console.log('a href clicked:', event.target.dataset.href);
  } else {
    console.log('click');
  }
});*/