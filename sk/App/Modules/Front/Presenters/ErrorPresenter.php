<?php

namespace App\Modules\Front\Presenters;

use App\Modules\Base\Presenters,
    Tracy\Debugger;

/**
 * Description of Error
 *
 * @author miroslav.petras
 */
class ErrorPresenter extends Presenters\BasePresenter {
    /**
     * zpracuje error pozadavek a vykresli error stranku
     * - vola ob_get_clean(), protoze jiz muze byt neco vyrenderovano (nez doslo k chybe)
     * 
     * @param Exception
     * @return void
     */
    public function renderDefault($exception) {
        ob_get_clean();

        if ($this->isAjax()) { // AJAX request? Just note this error in payload.
            $this->payload->error = TRUE;

            Debugger::log($exception, Debugger::EXCEPTION);
            $this->terminate();
        } elseif ($exception instanceof \Nette\Application\BadRequestException) {
            $this->template->errorCode = 404;
        } elseif ($exception instanceof \Exception) {
            $this->template->errorCode = $exception->getCode();

            Debugger::log($exception, Debugger::EXCEPTION);
        } else {
            $this->template->errorCode = 500;

            Debugger::log($exception, Debugger::EXCEPTION);
        }
    }

}
