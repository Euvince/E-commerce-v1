<?php 

namespace HTML;

class Modal 
{
    public static function ReturnModal (?string $count = null, ?string $word = "", ?string $uri = ""): string
    {
        return <<<HTML
        <div class="modal fade" id="deleteElement{$count}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer le {$word} ?</p>
                </div>
                <div class="modal-footer">
                    <a href="{$uri}" type="button" class="btn btn-primary">Save changes</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
HTML;
    }
}