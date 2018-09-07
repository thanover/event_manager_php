<div class="container">
    <div class="section">
        <ul class="collapsible expandable">
            <li>
                <div class="collapsible-header grey lighten-4">
                    Invites
                    <?php                        
                        $invited_events = get_invites_by_userID_and_status($currentUser['userID'], 'invited');
                        $numinvites = count($invited_events);
                        if ($numInvites > 0){
                            echo '<span class="new badge" data-badge-caption="events">'.$numInvites.'</span>';
                        }
                    ?>
                </div>
                <div class="collapsible-body">
                    <!-- Invites Cards -->
                    <div class="row">
                        <?php
                            if(count($invited_events) == 0){
                                echo "No new invites...";
                            } 
                            foreach ($invited_events as $invited_events): 
                            $event = get_event_by_eventID($invited_events['eventID']); 
                            ?>
                            <div class="col s4">
                                <div class="card small">

                                    <div class="card-action">
                                        <a href="./?action=accept_invite&eventID=<?php echo $event['eventID']; ?>&userID=<?php echo $currentUser['userID']; ?>">
                                            <button class="waves-effect waves-light btn green darken-1">
                                            <i class="material-icons left">check</i>Accept</button>
                                        </a>
                                        <a href="./?action=decline_invite&eventID=<?php echo $event['eventID']; ?>&userID=<?php echo $currentUser['userID']; ?>">
                                        <button class="btn waves-effects waves-light red darken-3"><i class="material-icons left">clear</i>Decline</button>
                                        </a>
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
                    <!-- End Invites Cards -->
                </div>
            </li>
            <li>
                <div class="collapsible-header grey lighten-4">
                    Accepted Events
                    <?php
                        $accepted_events = get_invites_by_userID_and_status($currentUser['userID'], 'accepted');
                        $numEvents = count($accepted_events);
                        if($numEvents > 0){
                            echo '<span class="badge" data-badge-caption="events">'.$numEvents.'</span>';
                        }
                    
                    ?>
                </div>
                <div class="collapsible-body">
                    <!-- Accepted Events Cards -->
                    <div class="row">
                        
                        <?php 
                        if(count($accepted_events) == 0){
                            echo "No Events...";
                        } 
                        foreach ($accepted_events as $accepted_event): 
                        $event = get_event_by_eventID($accepted_event['eventID']);

                        
                        ?> 
                        <div class="col s4">
                            <div class="card small">
                                <div class="card-action">
                                    <a href="./?action=decline_invite&eventID=<?php echo $event['eventID']; ?>&userID=<?php echo $currentUser['userID']; ?>">
                                        <button class="btn waves-effects waves-light red darken-3"><i class="material-icons left">clear</i>Decline</button>
                                    </a>
                                </div>

                                <div class="card-content">
                                    <h5>
                                        <?php echo $event['eventTitle'];?>
                                    </h5>
                                    <h6>
                                    <?php 
                                        $date = DateTime::createFromFormat('Y-m-d', $event['eventDate']);
                                        $eventDate = $date->format('D, d M Y');
                                        echo $eventDate;
                                    ?>
                                    </h6>
                                    <div class="divider"></div>
                                    <br>
                                    <p class="card_desc">
                                        <?php echo $event['eventDesc'];?>
                                    </p>
                                </div>

                            </div>
                        </div>

                        <?php endforeach; ?>
                    </div>
                    <!-- End Accepted Events Cards -->
                </div>
            </li>

            <li>
                <div class="collapsible-header grey lighten-4">
                    Declined Events
                    <?php
                        $declined_events = get_invites_by_userID_and_status($currentUser['userID'], 'declined');
                        $numEvents = count($declined_events);
                    ?>
                    <span class="badge" data-badge-caption="events"><?php echo $numEvents; ?></span>
                </div>
                <div class="collapsible-body">
                    <!-- Declined Events Cards -->
                    <div class="row">
                        <?php 
                        if(count($declined_events) == 0){
                            echo "No declined invites...";
                        } 
                        foreach ($declined_events as $declined_event): 
                        $event = get_event_by_eventID($declined_event['eventID']);
                        ?> 
                        <div class="col s4">
                            <div class="card small">
                                <div class="card-action">
                                <a href="./?action=accept_invite&eventID=<?php echo $event['eventID']; ?>&userID=<?php echo $currentUser['userID']; ?>">
                                            <button class="waves-effect waves-light btn green darken-1">
                                            <i class="material-icons left">check</i>Accept</button>
                                        </a>
                                </div>

                                <div class="card-content">
                                    <h5>
                                        <?php echo $event['eventTitle'];?>
                                    </h5>
                                    <h6>
                                    <?php 
                                        $date = DateTime::createFromFormat('Y-m-d', $event['eventDate']);
                                        $eventDate = $date->format('D, d M Y');
                                        echo $eventDate;
                                    ?>
                                    </h6>
                                    <div class="divider"></div>
                                    <br>
                                    <p class="card_desc">
                                        <?php echo $event['eventDesc'];?>
                                    </p>
                                </div>

                            </div>
                        </div>

                        <?php endforeach; ?>
                    </div>
                    <!-- End Accepted Events Cards -->
                </div>
            </li>
            
        </ul>














        <!--   end cards Section   -->

    </div>
</div>