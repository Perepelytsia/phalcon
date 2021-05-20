<?php
declare(strict_types=1);

class SignupController extends ControllerBase
{
    public function indexAction()
    {
    }

    public function registerAction()
    {
        $user = new Users();
        $user->name = $this->request->getPost("name");
        $user->password = $this->request->getPost("password");
        $user->email = $this->request->getPost("email");
        $user->active = 1;
        $success = $user->save();
        if ($success) {
            echo "Спасибо за регистрацию!";
        } else {
            echo "К сожалению, возникли следующие проблемы: ";
            $messages = $user->getMessages();
            foreach ($messages as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }

        $this->view->disable();
    }
}

