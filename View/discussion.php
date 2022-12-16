<?php


function afficherDiscussion($idRoom,$roomName,$idUser,$nom,$prenom,$dateCrea) {
    echo '<tr class="inner-box">
    <th scope="row">
        <div class="event-date">
            <p>'.$roomName.'</p>
        </div>
    </th>
    <td>
    <div class="meta">
                
                <div class="time"> <span>'.$dateCrea.'</span></div>
            </div>
    </td>
    <td>
        <div class="event-img"> <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" style="width:50px; border-radius:50%;"></div>
    
        <div class="event-wrap">
            <h5><a href="profileAutre.php?iduser='.$idUser.'">'.$nom.' '.$prenom.'</a></h5>
            
        </div>
    </td>
    <td>
        <div class="primary-btn"> <a class="btn btn-primary" href="chat.php?room='.$idRoom.'">Ouvrir</a></div>
    </td>
</tr>';



}

?>

