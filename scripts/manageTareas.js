tareaList = document.getElementById('tarea-list');
tareaInput = document.getElementById('tarea-input');
deleteButtons = document.querySelectorAll('.delete-tarea');

document.addEventListener('DOMContentLoaded', async () => {
  let data = await fetchData({ action: 'createTareasHTML', method: 'GET' });
  tareaList.innerHTML = data;
});

document.getElementById('add-tarea').addEventListener('submit', async e => {
  e.preventDefault();
  let data = await fetchData({
    action: 'addTarea',
    method: 'POST',
    fd: new FormData(e.target),
  });

  tareaList.innerHTML = data;
  tareaInput.value = '';
});

document.getElementById('clear-tareas').addEventListener('click', async () => {
  let data = await fetchData({ action: 'clearTareas', method: 'POST' });

  tareaList.innerHTML = data;
});

document.getElementById('sort-tareas').addEventListener('click', async e => {
  let icon = e.target.closest('#sort-tareas').querySelector('svg');
  let data = null;
  icon.classList.toggle('fa-sort-amount-down');
  icon.classList.toggle('fa-sort-amount-up');

  if (icon.classList.contains('fa-sort-amount-up')) {
    data = await fetchData({ action: 'sortTareasDesc', method: 'POST' });
  } else {
    data = await fetchData({ action: 'sortTareasAsc', method: 'POST' });
  }
  tareaList.innerHTML = data;
});

document.getElementById('filter-fetcha').addEventListener('submit', async e => {
  e.preventDefault();

  data = await fetchData({
    action: 'filterFetcha',
    method: 'POST',
    fd: new FormData(e.target),
  });

  tareaList.innerHTML = data;
});

tareaList.addEventListener(
  'click',
  async e => {
    e.preventDefault();

    if (e.target.closest('.delete-tarea')) {
      let formData = new FormData();
      formData.append('id', e.target.closest('.delete-tarea').dataset.id);
      let data = await fetchData({
        action: 'deleteTarea',
        method: 'POST',
        fd: formData,
      });

      tareaList.innerHTML = data;
    }
  },
  false
);

async function fetchData({ action, method, fd }) {
  let res;
  let url = 'Controller/Controller.php';

  if (!fd) {
    fd = new FormData();
  }

  fd.append('action', action);

  try {
    if (method == 'GET') {
      res = await fetch(url);
    } else {
      res = await fetch(url, {
        method: 'POST',
        body: fd,
      });
    }

    if (res.ok) {
      let data = await res.text();

      return data;
    } else {
      console.log(err);
    }
  } catch (err) {
    console.log(err);
  }

  return 'Something went wrong';
}
