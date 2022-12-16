<?php

$titre = "Colearnio - Messagerie";
include_once __DIR__ . '/View/header_monespace.php';
?>

<div class="row">
    <div class="col">
        <h1 aria-label="breadcrumb" class="titre rounded-3 p-3 mb-4">Messagerie</h1>
    </div>
</div>

<div class="row">
<div class="container p-2 my-2 col-sm-12 col-lg-6 text-center">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"></path>
        </svg>
        Nouvelle conversation
    </button>
</div>
<div class="col-sm-12 col-lg-6 d-flex justify-content-center align-items-center">
    <form method="POST" action="" name="myDiscussion" class="d-flex justify-content-center align-items-center">
    <input <?php if(isset($_POST['checkBoxDisc'])) echo 'checked';?> class="ms-2" type="checkbox" type=submit name="checkBoxDisc" id="checkBoxDisc" style="width:20px; height:20px;">
    <label class="me-2" for="checkBoxDisc">Uniquement celles créées</label>
        <input class="btn btn-primary" type="submit" value="Voir" name="checkBoxSubmit" id="btn-checkbox">
        
    </form>
</div>
</div>


<div class="container">
    <h4 class="text-secondary text-center">Vos conversations</h4>
    <table class="table table-responsive table-striped">
        <thead>
            <th>Nom</th>
            <th>Date création</th>
            <th>Propriétaire</th>
            <th>Action</th>
        </thead>
        <tbody>
        <?php 
        include_once __DIR__.'/query/chatroom.php';
        if (isset($_POST['checkBoxDisc'])) {
          
            $listRoom = getCreatedRoomsOfUser($_SESSION['user']->idUser);
             
            if ($listRoom) {
                include_once __DIR__.'/View/discussion.php';
                foreach ($listRoom as $room) {
                   
                    $infoRoom = getProperChatRoomUser($room->idUser,$room->idChatRoom);
                    afficherDiscussion(
                        $infoRoom->idChatRoom,
                        $infoRoom->nomCR,
                        $infoRoom->idUser,
                        $infoRoom->nom,
                        $infoRoom->prenom,
                        $infoRoom->dateCreaCR);
                }
            }
        } else {
           
            $listRoom = getChatRoomUser($_SESSION['user']->idUser);
             
            if ($listRoom) {
                include_once __DIR__.'/View/discussion.php';
                foreach ($listRoom as $room) {
                   
                    $infoRoom = getProperChatRoomUser($room->idUser,$room->idChatRoom);
                    afficherDiscussion(
                        $infoRoom->idChatRoom,
                        $infoRoom->nomCR,
                        $infoRoom->idUser,
                        $infoRoom->nom,
                        $infoRoom->prenom,
                        $infoRoom->dateCreaCR);
                }
            }
        }
                
                
        ?>
        </tbody>
    </table>
</div>
<!-- Liste des conversations -->



<!-- Modal (fenêtre pop-up) pour la création d'une conversation -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> Nouvelle conversation <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-wechat" viewBox="0 0 16 16">
                        <path d="M11.176 14.429c-2.665 0-4.826-1.8-4.826-4.018 0-2.22 2.159-4.02 4.824-4.02S16 8.191 16 10.411c0 1.21-.65 2.301-1.666 3.036a.324.324 0 0 0-.12.366l.218.81a.616.616 0 0 1 .029.117.166.166 0 0 1-.162.162.177.177 0 0 1-.092-.03l-1.057-.61a.519.519 0 0 0-.256-.074.509.509 0 0 0-.142.021 5.668 5.668 0 0 1-1.576.22ZM9.064 9.542a.647.647 0 1 0 .557-1 .645.645 0 0 0-.646.647.615.615 0 0 0 .09.353Zm3.232.001a.646.646 0 1 0 .546-1 .645.645 0 0 0-.644.644.627.627 0 0 0 .098.356Z" />
                        <path d="M0 6.826c0 1.455.781 2.765 2.001 3.656a.385.385 0 0 1 .143.439l-.161.6-.1.373a.499.499 0 0 0-.032.14.192.192 0 0 0 .193.193c.039 0 .077-.01.111-.029l1.268-.733a.622.622 0 0 1 .308-.088c.058 0 .116.009.171.025a6.83 6.83 0 0 0 1.625.26 4.45 4.45 0 0 1-.177-1.251c0-2.936 2.785-5.02 5.824-5.02.05 0 .1 0 .15.002C10.587 3.429 8.392 2 5.796 2 2.596 2 0 4.16 0 6.826Zm4.632-1.555a.77.77 0 1 1-1.54 0 .77.77 0 0 1 1.54 0Zm3.875 0a.77.77 0 1 1-1.54 0 .77.77 0 0 1 1.54 0Z" />
                    </svg></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" name="formCreateRoom">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nom de la conversation:</label>
                        <input type="text" class="form-control" id="chatRoomName" name="chatRoomName">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="descRoom" name="descRoom"></textarea>
                    </div>
                    <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="closeCreateRoom">Fermer</button>
                <button type="submit" class="btn btn-success" id="btnCreateRoom">Créer</button>
            </div>
                </form>
            </div>
            <div class="error text-center mb-2 invisible" id="errorCreateRoom">
                Une erreur s'est produite
            </div>
            

            
        </div>
    </div>
</div>
<script src="./script/messagerie.js">

</script>
<?php
include_once __DIR__ . '/View/footer_index.php';
?>