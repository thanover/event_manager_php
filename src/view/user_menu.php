<li>
    <a href="./?action=list_events">My Events
        <?php
        $invites = get_invite_count_by_userID_and_status($currentUser['userID'], 'invited');
        $numInvites = $invites['total'];
        if ($numInvites > 0){
            echo '<span class="new badge">'.$numInvites.'</span>';
        }
        ?>
    </a>
</li>
