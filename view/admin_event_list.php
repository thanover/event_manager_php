<!-- this generates the list of events that the admin sees  -->

<div class="container">
        <div class="section">
        <div class="row">
            <a href=".?action=show_add_event_form" class="waves-effect waves-light btn green darken-1">
                <i class="material-icons left">add_circle_outline</i>Add A New Event</a>
        </div>
        <?php $events = get_all_events(); ?>
        <!--   cards Section   -->
        <div class="row">
        <?php foreach ($events as $event): ?>            
                <div class="col s4">
                    <div class="card small">
                        <div class="card-action">
                            <a href="./?action=show_edit_event_form&eventID=<?php echo $event['eventID']; ?>" class="waves-effect waves-light btn blue darken-3">
                            <i class="material-icons left">info_outline</i>Event Details</a>
                        </div>
                        
                        <div class="card-content">
                            <h5><?php echo $event['eventTitle'];?></h5>
                            <h6>
                                <?php 
                                    $date = DateTime::createFromFormat('Y-m-d', $event['eventDate']);
                                    $eventDate = $date->format('D, d M Y');
                                    echo $eventDate;
                                ?>
                            </h6>
                            <div class="divider"></div>
                                <br>
                                <p class="card_desc"><?php echo $event['eventDesc'];?></p>                       
                        </div>

                    </div>
                </div>
            
            <?php endforeach; ?>
            </div>
            <!--   end cards Section   -->
            
        </div>
    </div>
