<?php

namespace HTML;

class Form
{

    public function form (
        $my_uri, 
        string $inputTextName, 
        string $textareaName, 
        string $inputPriceName,
        string $inputDateName,
        string $inputFileName,
        ?string $imgTitle, 
        $inputDateType,
        ?string $inputTextValue = null, 
        ?string $textareaValue = null,
        ?string $priceValue = null,
        ?string $dateValue = null,
        ?string $picture = null,
        ?string $hiddenInputValue = null
    ): string
    {
        $pictureView = "";
        $hiddenInput = "";
        if (isset($picture))
        {
            $uri = $picture;
            $pictureView .= <<<HTML
            <h5 class="mt-2">Image : </h5>
            <img class="mt-2" src="{$uri}" style="width:530px; height:445px; border-radius:15px;">
HTML;
        }
        if (isset($hiddenInputValue))
        {
            $hiddenInput .= <<<HTML
            <input type="hidden" name="identifiant" value="{$hiddenInputValue}">
HTML;
        }
        return <<<HTML
        <form action="{$my_uri}" method="POST" enctype="multipart/form-data">
            <fieldset>
                <div class="row">
                    <div class="col-7">
                        <div class="form-group">
                            <label for="title" class="form-label mt-3">Ajouter un titre</label>
                            <input type="text" class="form-control" data-qv-rules="required|startWithLetter|between:2,80|only:string" id="title" name="{$inputTextName}" value="{$inputTextValue}" required>
                            <div data-qv-feedback="title" style="color: red; font-size: 15px;"></div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="form-label mt-4">Ajouter du contenu</label>
                            <textarea class="form-control" data-qv-rules="required|startWithLetter|min:40|only:string"  id="content" rows="3" name="{$textareaName}" required>{$textareaValue}</textarea>
                            <div data-qv-feedback="content" style="color: red; font-size: 15px;"></div>
                            <small class="form-text text-muted">Entrez du contenu.</small> <br>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="price" class="form-label mt-4">Ajouter un prix</label>
                                    <input type="number" class="form-control" data-qv-rules="required|min:3|only:number" id="price" name="{$inputPriceName}" value="{$priceValue}" required>
                                    <div data-qv-feedback="price" style="color: red; font-size: 15px;"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="date" class="form-label mt-4">Ajouter une date</label>
                                    <input type="{$inputDateType}" class="form-control" data-qv-rules="required" id="date" name="{$inputDateName}" value="{$dateValue}" required>
                                    <div data-qv-feedback="date" style="color: red; font-size: 15px;"></div>
                                </div>
                            </div>
                        </div>
                        <br />
                        <label for="picture" class="form-label">{$imgTitle}</label>
                        <input class="form-control" type="file"  data-qv-rules="required|file|maxFileSize:1MB" id="picture" name="{$inputFileName}">
                        <div data-qv-feedback="picture" style="color: red; font-size: 15px;"></div>
                        {$hiddenInput}
                        <button type="submit" class="btn btn-primary mt-3" data-qv-submit>Soumettre</button>
                    </div>
                    <div class="col-5 mt-2">{$pictureView}</div>
                </div>
            </fieldset>
        </form>

        <script src="../Assets/js/quickv.js"></script>
        <script>
            const qv = new Quickv();
            qv.init();
        </script>
HTML;
    }

}