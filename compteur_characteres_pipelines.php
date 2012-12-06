<?php
/**
 * Plugin Compteur de charactères
 * (c) 2012 Rainer Müller
 * Licence GNU/GPL
 */

if (!defined('_ECRIRE_INC_VERSION')) return;


function compteur_characteres_header_prive($flux){
    $flux .= '<script type="text/javascript" charset="utf-8" src="'.find_in_path('javascript/jquery.simplyCountable.js').'"></script>';
    $flux .= "<script type='text/javascript' charset='utf-8'>
        $(document).ready(function()
        {
          $('#descriptif').simplyCountable({
               counter: '.compteur_descriptif',
                countDirection: 'up',
                maxCount: 100,
          });
          $('#text_area').simplyCountable({
            counter: '.compteur_text_area',
            countType: 'characters',
            countDirection: 'up',
            maxCount: 500,
          });
        });
    </script>";
    $flux .= '<link id="cssprivee" href="'.find_in_path('css/styles_compteur_characteres.css').'" type="text/css" rel="stylesheet">';
    return $flux;
}

function compteur_characteres_recuperer_fond($flux){
    //Insertion des onglets de langue
    $texte=$flux['data']['texte'];
    if ($flux['args']['fond'] == 'formulaires/editer_article'){
        $descriptif='<div class="compteur"><span class="compteur_descriptif"></span>'._T('compteur_caracteres:caracteres').'</div>';
        $textarea='<div class="compteur"><span class="compteur_text_area"></span>'._T('compteur_caracteres:caracteres').'</div>';        
        $patterns = array('/<textarea name=\'descriptif\'/','/<textarea name=\'texte\' /');
        $replacements = array($descriptif.'<textarea name=\'descriptif\'',$textarea.'<textarea name=\'texte\'');                        
       $flux['data']['texte'] = preg_replace($patterns,$replacements,$texte,1);
    }
    return $flux;
}
?>