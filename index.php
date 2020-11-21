<!DOCTYPE html>
<html class="has-navbar-fixed-top" lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gestor Tareas</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
	<link rel="stylesheet" property="stylesheet" href="libs/bulma-calendar-extension/css/bulma-calendar.min.css">
</head>

<body <div class="box">
	<div class="level is-mobile">
		<div class="level-left">
			<h2 class="title is-4">Tasks</h2>
		</div>
		<div class="level-right">
			<button id="clear-tasks" class="ml-6 button is-danger is-light">
				<span>Clear all tasks</span>
				<span class="icon">
					<i class="fas fa-trash"></i>
				</span>
			</button>
		</div>
	</div>

	<form id="add-task" action="" method="POST" style="max-width: 600px;">
		<div class="field has-addons">
			<div class="control">
				<span class="select">
					<select name="priority">
						<option disabled>- Priority -</option>
						<option value="3"><span class="has-text-primary">High</span></option>
						<option value="2" selected>Medium</option>
						<option value="1">Low</option>
					</select>
				</span>
			</div>
			<div class="control is-expanded has-icons-left">
				<input id="task-input" required name="title" class="input" type="text" placeholder="Add task">
				<span class="icon is-small is-left">
					<i class="fas fa-tasks"></i>
				</span>
			</div>
			<div class="control">
				<button id="add-task-btn" type="submit" class="button is-primary" type="submit">Add task</button>
			</div>
		</div>
		<input id="date" required name="due-date" type="date">
	</form>
	<hr>
	<div>
		<button id="sort-tasks" class="button mb-4">
			<span class="icon is-small">
				<i class="fas fa-sort-amount-down"></i>
			</span>
			<span>
				Priority
			</span>
		</button>
		<form id="filter-date" action="" method="POST">
			<div class="field has-addons">
				<div class="control" style="width:260px">
					<input required name="date" class="input" type="date" placeholder="Add task">
				</div>
				<div class="control">
					<button type="submit" class="button is-primary mb-4">
						<span class="icon is-small">
							<i class="fas fa-filter"></i>
						</span>
						<span>
							Filter Date
						</span>
					</button>
				</div>
			</div>
			<div id="task-list">
			</div>
		</form>
	</div>
	</div>

	<script src="libs/bulma-calendar-extension/js/bulma-calendar.min.js"></script>
	<script>
		const calendars = bulmaCalendar.attach('[type="date"]', {
			type: 'date',
			dateFormat: 'DD/MM/YYYY',
			startDate: new Date()
		});

		// Loop on each calendar initialized
		calendars.forEach(calendar => {
			// Add listener to date:selected event
			calendar.on('date:selected', date => {
				console.log(date);
			});
		});
	</script>
	<script src="scripts/Modal.class.js"></script>
	<script src="scripts/manageTasks.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
</body>

</html>