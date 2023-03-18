<?php  

namespace Admin\biblioteca\CrudFarad;


class Paginacao {
    public $current_page;
    public $per_page;
    public $total_count;
    public $num_pages;
    public $num_buttons;
    public $url;

    function __construct($page=1, $per_page=20, $total_count, $num_buttons=5, $url) {
        $this->current_page =  $this->validate_page($page);
        $this->per_page = (int)$per_page;
        $this->total_count = (int)$total_count;
        $this->num_buttons = (int)$num_buttons;
        $this->url = $url;
        $this->num_pages = ceil($this->total_count/$this->per_page);
    }
    
    public function validate_page($page) {
        if (!is_numeric($page)) {
            $page = 1;
        }
        return (int)$page;
    }

    public function offset() {
        return ($this->current_page - 1) * $this->per_page;
    }

    public function previous_page() {
        return $this->current_page - 1;
    }

    public function next_page() {
        return $this->current_page + 1;
    }

    public function has_previous_page() {
        return $this->previous_page() >= 1 ? true : false;
    }

    public function has_next_page() {
        return $this->next_page() <= $this->num_pages ? true : false;
    }

    public function render_pages($selected_page = 1) {
        $html ='';
        $start = $selected_page - floor($this->num_buttons/2);
        $end = $start + $this->num_buttons - 1;
        if ($start < 1) {
            $start = 1;
            $end = min($this->num_pages, $this->num_buttons);
        }
        if ($end > $this->num_pages) {
            $end = $this->num_pages;
            $start = max(1, $end - $this->num_buttons + 1);
        }
        for ($i = $start; $i <= $end; $i++) {
            if ($i == $selected_page) {
                $html .= "<li  class='page-item active'><a class='page-link'> " . $i . "</a> </li>";
            } else {
                $html .= "<li  class='page-item'><a class='page-link'  href='" . $this->url . "?p=" . $i . "'>" . $i . "</a> </li>";
            }
        }
        if ($this->has_previous_page()) {
            $html = "<a class='page-link'  href='" . $this->url . "?p=" . $this->previous_page() . "'>&laquo;</a>" . $html;
        }
        if ($this->has_next_page()) {
            $html .= " <a class='page-link' href='" . $this->url . "?p=" . $this->next_page() . "'>&raquo;</a>";
        }
        return '<ul class="pagination pagination-sm m-0 float-left">'.$html.'</ul>';
    }
}



