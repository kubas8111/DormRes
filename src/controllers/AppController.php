<?php

class AppController {
<<<<<<< HEAD
    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/'. $template.'.php';
        $output = 'File not found';
                
        if(file_exists($templatePath)){
            extract($variables);
            
=======

    protected function render(string $template = null) {
        $templatePath = 'public/views/'.$template.'.html';
        $output = 'File not found'; 

        if(file_exists($templatePath)) {
>>>>>>> d27064f49e76d0335c7a4faf191f81190ed0894a
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
<<<<<<< HEAD
=======

>>>>>>> d27064f49e76d0335c7a4faf191f81190ed0894a
        print $output;
    }
}