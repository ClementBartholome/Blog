<?php

class View {

    private string $file; // File path of the view
    private string $title; // Title of the view

    public function __construct(string $action) {
        // Sets the file path based on the provided action
        $this->file = "View/view" . $action . ".php";
        $this->title = "";
    }

    public function generate(array $data): void {
        // Generate the view using provided data
        $content = $this->generateFile($this->file, $data);
        
        // Get the root web directory from the configuration
        $racineWeb = Configuration::get("racineWeb", "/");
        
        // Generate the complete view by including the template and passing necessary data
        $view = $this->generateFile('View/template.php',
            array('title' => $this->title, 'content' => $content,
                  'racineWeb' => $racineWeb));
        echo $view;
    }

    private function generateFile(string $file, array $data): string {
        // Check if the specified file exists
        if (file_exists($file)) {
            // Extract the data array into variables
            extract($data);
            ob_start();
            // Include the specified file, which will capture its output into the buffer
            require $file;
            return ob_get_clean();
        }
        else {
            throw new Exception("file '$file' not found");
        }
    }
}
