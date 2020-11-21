taskList = document.getElementById('task-list');
taskInput = document.getElementById('task-input');
deleteButtons = document.querySelectorAll('.delete-task');

document.addEventListener('DOMContentLoaded', async () => {
  let data = await fetchData({ action: 'createTasksHTML', method: 'GET' });
  taskList.innerHTML = data;
});

document.getElementById('add-task').addEventListener('submit', async e => {
  e.preventDefault();
  let data = await fetchData({
    action: 'addTask',
    method: 'POST',
    fd: new FormData(e.target),
  });

  taskList.innerHTML = data;
  taskInput.value = '';
});

document.getElementById('clear-tasks').addEventListener('click', async () => {
  let data = await fetchData({ action: 'clearTasks', method: 'POST' });

  taskList.innerHTML = data;
});

document.getElementById('sort-tasks').addEventListener('click', async e => {
  let icon = e.target.closest('#sort-tasks').querySelector('svg');
  let data = null;
  icon.classList.toggle('fa-sort-amount-down');
  icon.classList.toggle('fa-sort-amount-up');

  if (icon.classList.contains('fa-sort-amount-up')) {
    data = await fetchData({ action: 'sortTasksDesc', method: 'POST' });
  } else {
    data = await fetchData({ action: 'sortTasksAsc', method: 'POST' });
  }
  taskList.innerHTML = data;
});

document.getElementById('filter-date').addEventListener('submit', async e => {
  e.preventDefault();

  data = await fetchData({
    action: 'filterDate',
    method: 'GET',
    fd: new FormData(e.target),
  });

  taskList.innerHTML = data;
});

taskList.addEventListener(
  'click',
  async e => {
    e.preventDefault();

    if (e.target.closest('.delete-task')) {
      let formData = new FormData();
      formData.append('id', e.target.closest('.delete-task').dataset.id);
      let data = await fetchData({
        action: 'deleteTask',
        method: 'POST',
        fd: formData,
      });

      taskList.innerHTML = data;
    }
  },
  false
);

async function fetchData({ action, method, fd }) {
  let res;

  if (!fd) {
    fd = new FormData();
  }

  fd.append('action', action);

  try {
    if (method == 'GET') {
      res = await fetch('controller/tareas.php');
    } else {
      res = await fetch('controller/tareas.php', {
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
