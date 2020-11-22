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
			<h2 class="title is-4">Tareas</h2>
		</div>
		<div class="level-right">
			<button id="clear-tareas" class="ml-6 button is-danger is-light">
				<span>Borrar tareas</span>
				<span class="icon">
					<i class="fas fa-trash"></i>
				</span>
			</button>
		</div>
	</div>

	<form id="add-tarea" action="" method="POST" style="max-width: 600px;">
		<div class="field has-addons">
			<div class="control">
				<span class="select">
					<select name="prioridad">
						<option disabled>- Prioridad -</option>
						<option value="3"><span class="has-text-primary">Alto</span></option>
						<option value="2" selected>Medio</option>
						<option value="1">Bajo</option>
					</select>
				</span>
			</div>
			<div class="control is-expanded has-icons-left">
				<input id="tarea-input" required name="titulo" class="input" type="text" placeholder="Añadir tarea">
				<span class="icon is-small is-left">
					<i class="fas fa-tasks"></i>
				</span>
			</div>
			<div class="control">
				<button id="add-tarea-btn" type="submit" class="button is-primary" type="submit">Añadir tarea</button>
			</div>
		</div>
		<input id="fetcha" required name="fetcha" type="date">
	</form>
	<hr>
	<div>
		<button id="sort-tareas" class="button mb-4">
			<span class="icon is-small">
				<i class="fas fa-sort-amount-down"></i>
			</span>
			<span>
				Prioridad
			</span>
		</button>
		<form id="filter-fetcha" action="" method="POST">
			<div class="field has-addons">
				<div class="control" style="width:260px">
					<input required name="fetcha" class="input" type="date">
				</div>
				<div class="control">
					<button type="submit" class="button is-primary mb-4">
						<span class="icon is-small">
							<i class="fas fa-filter"></i>
						</span>
						<span>
							Filtrar Fetcha
						</span>
					</button>
				</div>
			</div>
			<div id="tarea-list">
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
	<script src="scripts/manageTareas.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
</body>

</html>