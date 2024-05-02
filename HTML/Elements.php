<?php

namespace HTML;

use Controllers\GeneralController;

class Elements
{
    public static function displayElements (
        $elements, 
        string $route1, 
        string $route2, 
        string $route3,
        string $route4, 
        string $word,
        ?int $count = 0
    ): string
    {
        $img = $elements->getPicture();
        $src = file_exists('img/' . $img) ? 'img/' . $img : $elements->getPicture();
        $my_uri2 = URL . $route1 . $elements->getId();
        $my_uri4 = URL . $route2 . $elements->getId();
        $my_uri5 = URL . $route3 . $elements->getId();
        $my_uri6 = URL . $route4 . $elements->getId();
        $modifying = "";
        $deleting = ""; 
        $details = '<a href="'.$my_uri2.'" class="btn btn-primary mx-3 my-2"><i class="fa-solid fa-eye me-2"></i>Détails</a>';
        $ficheT = '<a href="'.$my_uri6.'" class="btn btn-info mx-3 my-2"><i class="fa-solid fa-download me-2"></i>Fiche Technique</a>';
        if (isset ($_SESSION['admin']) && $_SESSION['admin'] === true)
        {
            $modifying .= <<<HTML
                <a href="{$my_uri5}" class="btn btn-warning mx-3 my-2">Modification</a>
            HTML;
            $deleting .= <<<HTML
                <a href="{$my_uri4}" class="btn btn-danger mx-3 my-2" data-bs-toggle="modal" data-bs-target="#deleteElement{$count}">Suppression</a>
            HTML;
            $details = "";
            $ficheT = "";
        }
        $g = new GeneralController();
        $title = $elements->getTitle();
        $content = $elements->getContent();
        return <<<HTML
        <div class="col-3 my-3">
            <div class="card mb-3">
                <h3 class="card-header">{$g::FormattedTitle($title)}</h3>
                <div class="card-body">
                    <h6 class="card-subtitle text-muted">{$elements->getCreatedAt()->format('d F Y H:i:s')}</h6>
                </div>
                    <img src="{$src}" style="width:296px; height:200px" alt="">
                <div class="card-body">
                    <p class="card-text">{$g::Excerpt($content)}</p>
                </div>
                {$modifying}
                {$deleting}
                {$details}
                {$ficheT}
            </div>

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
                        <a href="{$my_uri4}" type="button" class="btn btn-primary">Save changes</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function search()
            {
                var search_val = document.getElementById('search').value;
                fetch('http://localhost/GESTION%20MVC%202.0/plats/p', {
                    method: "POST"
                })
                .then(response => response.text())
                .then(data => {
                   /*  document.getElementById('results').innerHTML = data; */
                   console.log(data);
                })
                .catch(error => {
                    console.error('Erreur' : error);
                });
            }
            document.getElementById('search').addEventListener('input', search());
        </script>
HTML;
    }

    public static function footer ($elements): array
    {
        $btns = [];
        return [self::previousLink($elements),self::nextLink($elements)];
    }

    private static function previousLink (string $elements): string
    {
        $uri_one = URL . $elements;
        return <<<HTML
        <a href="{$uri_one}" class="btn btn-primary btn-sm btn-left">&laquo; Page Précédente</a>
HTML;
    }

    private static function nextLink (string $elements): string
    {
        $uri_two = URL . $elements;
        return <<<HTML
         <a href="{$uri_two}" class="btn btn-primary btn-sm btn-right">Page Suivante &raquo;</a>
HTML;
    }
}