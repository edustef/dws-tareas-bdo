taskList = document.getElementById("task-list");
taskInput = document.getElementById("task-input");
deleteButtons = document.querySelectorAll(".delete-task");

document.addEventListener("DOMContentLoaded", async () => {
  let data = await fetchData("createTasksHTML", 'GET');
  taskList.innerHTML = data;
});

document.getElementById("add-task").addEventListener("submit", async (e) => {
  e.preventDefault();
  let data = await fetchData("addTask", new FormData(e.target));

  taskList.innerHTML = data;
  taskInput.value = "";
});

document.getElementById("clear-tasks").addEventListener("click", async () => {
  let data = await fetchData("clearTasks", new FormData());

  taskList.innerHTML = data;
});

document.getElementById("sort-tasks").addEventListener("click", async (e) => {
  let icon = e.target.closest("#sort-tasks").querySelector("svg");
  let data = null;
  icon.classList.toggle("fa-sort-amount-down");
  icon.classList.toggle("fa-sort-amount-up");

  if (icon.classList.contains("fa-sort-amount-up")) {
    data = await fetchData("sortTasksDesc", new FormData());
  } else {
    data = await fetchData("sortTasksAsc", new FormData());
  }
  taskList.innerHTML = data;
});

document.getElementById("filter-date").addEventListener("submit", async (e) => {
  e.preventDefault();

  formData = new FormData(e.target);
  data = await fetchData("filterDate", formData);

  taskList.innerHTML = data;
});

taskList.addEventListener(
  "click",
  async (e) => {
    e.preventDefault();

    if (e.target.closest(".delete-task")) {
      let formData = new FormData();
      formData.append("id", e.target.closest(".delete-task").dataset.id);
      let data = await fetchData("deleteTask", formData);

      taskList.innerHTML = data;
    }
  },
  false
);

async function fetchData(action, method, formData) {
  const fd = new FormData();

  if(formData) fd = formData;

  fd.append("action", action);

  try {
    let res = await fetch("controller/tasksController.php", {
      method: method,
      body: fd,
    });

    if (res.ok) {
      let data = await res.text();

      return data;
    } else {
      console.log(err);
    }
  } catch (err) {
    console.log(err);
  }

  return "Something went wrong";
}
