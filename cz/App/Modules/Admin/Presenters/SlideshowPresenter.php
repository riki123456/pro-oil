<?php

namespace App\Modules\Admin\Presenters;

use App\Components\Controls\Crud\SlideshowControl\TCreateComponentSlideshowControl;

class SlideshowPresenter extends AdminPresenter {
    /**
     * Vytvoří komponentu pagesControl
     */
    use TCreateComponentSlideshowControl;

    /**
     * @var array $presenterConfig konfigurace pro zakladni presenter akce, vyuzivano rodici
     * 
     * - pole 'titles' ma v indexech nazvy render method
     */
    protected $presenterConfig = array(
        'crud' => true,
        'presenter' => 'Slideshow',
        'tablename' => 'slideshow',
        'titles' => array(
            'default' => 'Správa slideshow - animace obrázků/bannerů',
            'edit' => 'Editace slide',
            'detail' => 'Detail slide',
            'add' => 'Nový slide',
            'delete' => 'Smazání slide'
        )
    );

    /**
     * Dokonceni zpracování page formuláře (vola se z komponenty).
     * 
     * @param UI\Form $form argumenty predane metoda z komponenty
     */
    public function successForm(\Nette\Application\UI\Form $form) {
        if ($form->isSubmitted()) {
            $this->redirect('default');
        }

        /*
          if ($this->presenter->isAjax()) {
          $this->presenter->redrawControl('flash');
          $this->presenter->redrawControl('content');
          } else {
          $this->presenter->redirect('default');
          }
         * 
         */
    }

}
