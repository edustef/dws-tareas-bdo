<?php
class VistaTarea
{

  public static function render($tareas)
  {
    $output = '';

    if (count($tareas) > 0) {
      foreach (array_reverse($tareas, true) as $tarea) {
        $tareaHTML = '';
        $titulo = $tarea->titulo;
        $tareaPassedStyle = array(
          'class' => '',
          'style' => ''
        );

        if ($tarea->prioridad == 1) {
          $prioridadStyle = 'has-text-primary';
        } elseif ($tarea->prioridad == 2) {
          $prioridadStyle = 'has-text-warning';
        } else {
          $prioridadStyle = 'has-text-danger';
        }

        $fetcha = DateTime::createFromFormat('Y-m-d', $tarea->fetcha);
        $fetchaFormatted = $fetcha->format('D d M Y');
        if ($fetcha < new DateTime('today')) {
          $tareaPassedStyle['class'] = 'has-text-grey';
          $tareaPassedStyle['style'] = 'text-decoration: line-through';
          $prioridadStyle = '';
        }

        $tareaHTML = '
      <div class="p-2 level has-background-light" style="border-bottom:1px solid #eee ;max-width: 900px">
        <div class="level-left" style="min-width:0;flex-shrink:unset;' . $tareaPassedStyle['style'] . '">
          <div class="level-item">
            <span class="icon ' . $prioridadStyle . '">
              <i class="fas fa-circle"></i>
            </span>
          </div>
          <div class="level-item" style="max-width:700px;min-width:0;flex-shrink:unset;white-space:wrap">
            ' . $titulo . '
          </div>
        </div>
        <div class="level-right">
          <div class="level-item has-text-grey is-size-7" >
          ' . $fetchaFormatted . '
          </div>
          <div class="level-item">
            <button data-id=' . $tarea->id . ' class="delete-tarea button is-danger is-outlined">
              <span class="icon">
                <i class="fas fa-trash"></i>
              </span>
            </button>
          </div>
        </div>
      </div>';

        $output .= $tareaHTML;
      }
    } else {
      $output = '
      <div class="level">
        <div class="level-left">
          <p class="is-size-5 is-italic has-text-grey-light">Your tarea list is empty! :(</p>
        </div>
      </div>
      ';
    }

    echo $output;
  }
}
