<?php
function createTasksHTML($tasks)
{
  $output = '';

  if (count($tasks) > 0) {
    foreach (array_reverse($tasks, true) as $key => $task) {
      $taskHTML = '';
      $title = $task['title'];
      $taskPassedStyle = array(
        'class' => '',
        'style' => ''
      );

      if ($task['priority'] == 1) {
        $priorityStyle = 'has-text-primary';
      } elseif ($task['priority'] == 2) {
        $priorityStyle = 'has-text-warning';
      } else {
        $priorityStyle = 'has-text-danger';
      }

      $dueDate = DateTime::createFromFormat('d/m/Y', $task['dueDate']);
      $dueDateFormated = $dueDate->format('D d M Y');
      if ($dueDate < new DateTime('today')) {
        $taskPassedStyle['class'] = 'has-text-grey';
        $taskPassedStyle['style'] = 'text-decoration: line-through';
        $priorityStyle = '';
      }

      $taskHTML = '
      <div class="p-2 level has-background-light" style="border-bottom:1px solid #eee ;max-width: 900px">
        <div class="level-left" style="min-width:0;flex-shrink:unset;' . $taskPassedStyle['style'] . '">
          <div class="level-item">
            <span class="icon ' . $priorityStyle . '">
              <i class="fas fa-circle"></i>
            </span>
          </div>
          <div class="level-item" style="max-width:700px;min-width:0;flex-shrink:unset;white-space:wrap">
            ' . $title . '
          </div>
        </div>
        <div class="level-right">
          <div class="level-item has-text-grey is-size-7" >
          ' . $dueDateFormated . '
          </div>
          <div class="level-item">
            <button data-id=' . $key . ' class="delete-task button is-danger is-outlined">
              <span class="icon">
                <i class="fas fa-trash"></i>
              </span>
            </button>
          </div>
        </div>
      </div>';

      $output .= $taskHTML;
    }
  } else {
    $output = '
      <div class="level">
        <div class="level-left">
          <p class="is-size-5 is-italic has-text-grey-light">Your task list is empty! :(</p>
        </div>
      </div>
      ';
  }


  return $output;
}
