<?php
$page_name = "Calendário";
$title = " - {$page_name}";
$css = [
    "assets/admin/css/plugins/iCheck/custom.css",
    "assets/admin/css/plugins/fullcalendar/fullcalendar.css",
    "assets/admin/css/plugins/fullcalendar/fullcalendar.print.css",
    
];
$script = [
    "assets/admin/js/plugins/fullcalendar/moment.min.js",
    "assets/admin/js/plugins/jquery-ui/jquery-ui.min.js",
    "assets/admin/js/plugins/iCheck/icheck.min.js",
    "assets/admin/js/plugins/fullcalendar/fullcalendar.min.js",

];

require APP . 'view/admin/_templates/initFile.php';
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $page_name;?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?=URL_ADMIN?>/dashboard">Inicio</a>
            </li>
            <li class="active">
                <strong><?php echo $page_name;?></strong>
            </li>
        </ol>
    </div>
</div>


<div class="wrapper wrapper-content">
    <div class="row animated fadeInDown">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Events Eventos</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id='external-events'>
                        <p>Drag a event and drop into callendar.</p>
                        <div class='external-event navy-bg'>Go to shop and buy some products.</div>
                        <div class='external-event navy-bg'>Check the new CI from Corporation.</div>
                        <div class='external-event navy-bg'>Send documents to John.</div>
                        <div class='external-event navy-bg'>Phone to Sandra.</div>
                        <div class='external-event navy-bg'>Chat with Michael.</div>
                        <p class="m-t">
                            <input type='checkbox' id='drop-remove' class="i-checks" checked /> <label
                                for='drop-remove'>remove after drop</label>
                        </p>
                    </div>
                </div>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <h2>FullCalendar</h2> is a jQuery plugin that provides a full-sized, drag & drop
                    calendar like the one below. It uses AJAX to fetch events on-the-fly for each month and
                    is
                    easily configured to use your own feed format (an extension is provided for Google
                    Calendar).
                    <p>
                        <a href="http://arshaw.com/fullcalendar/" target="_blank">FullCalendar
                            documentation</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $page_name;?></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>









<?php
require APP . 'view/admin/_templates/endFile.php';
?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#calendarModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="calendarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="<?=URL_ADMIN ?>/calendario/cadastrar" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calendarModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                    <label for="id_titulo">Titulo</label>
                    <input type="text" name="titulo" id="id_titulo" class="form-control" required>
                    <br>
                    <input type="hidden" name="data_agendamento" id="id_data_agendamento" class="form-control" required>
                    <input type="checkbox" name="status" id="id_status" checked> <label for="id_status">Ativo</label>
                    
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Criar</button>
            </div>
        </div>
    </form>
  </div>
</div>

<?php 
    $events = array();

    foreach ($response as $obj) {
        array_push($events, array(
            "id"=>$obj['id'],
            "start"=>$obj["data_agendamento"],
            "title"=>"Teste de titulo",
            "status"=>1,
        ));
    };
    print_r($events);
?>
<script>
    $(document).ready(function () {

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });

        /* initialize the external events
         -----------------------------------------------------------------*/

        $('#external-events div.external-event').each(function () {

            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1111999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            });

        });


        /* initialize the calendar
         -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({

            header: {
                locale: 'pt',
                left: 'prev,next today',
                center: 'title',
                right: 'month, agendaWeek, agendaDay'
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function () {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            events:<?php echo json_encode($events);?> 
        });


    });
</script>

<script>
$(document).ready(function () {

    var task = function(){
        console.log(this)
        console.log($(this).attr('data-date'))
        // $('#calendarModalLabel').prop(this['data-date'])
        $('#calendarModalLabel').text($(this).attr('data-date'))
        $('#id_data_agendamento').val($(this).attr('data-date'))
        $('#calendarModal').modal({ show: true})
        
        
    };

    $('.fc-future').click(task);
    $('.fc-today').click(task);

})

</script>