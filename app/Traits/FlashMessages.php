<?php

namespace App\Traits;

/**
 * Trait FlashMessages
 * @package App\Traits
 */
trait FlashMessages
{
    protected $errorMessages = [];
    protected $infoMessages = [];
    protected $successMessages = [];
    protected $warningMessages = [];

    /**
     * @param $message
     * @param $type
     */
    protected function setFlashMessage($message, $type)
    {
        $model = match ($type) {
            'info'      =>  'infoMessages',
            'error'     =>  'errorMessages',
            'success'   =>  'successMessages',
            'warning'   =>  'warningMessages',
        };

        if (is_array($message)) {
            foreach ($message as $key => $value) {
                array_push($this->$model, $value);
            }
        } else {
            array_push($this->$model, $message);
        }
    }

    /**
     * @return array
     */
    protected function getFlashMessage()
    {
        return [
            'error'     =>  $this->errorMessages,
            'info'      =>  $this->infoMessages,
            'success'   =>  $this->successMessages,
            'warning'   =>  $this->warningMessages,
        ];
    }

    /**
     * Flushing flash messages to Laravel's session
     */
    protected function showFlashMessages()
    {
        session()->flash('error', $this->errorMessages);
        session()->flash('info', $this->infoMessages);
        session()->flash('success', $this->successMessages);
        session()->flash('warning', $this->warningMessages);
    }
}
