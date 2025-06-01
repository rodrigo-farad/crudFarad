<?php

namespace Admin\biblioteca\CrudFarad;

class Paginacao {
    public $current_page;
    public $per_page;
    public $total_count;
    public $num_pages;
    public $num_buttons;
    public $url;
    public $js_function; // Nova variável para a função JavaScript

    /**
     * Construtor da classe.
     *
     * @param int $page Número da página atual (opcional, padrão: 1)
     * @param int $per_page Número de itens por página (opcional, padrão: 20)
     * @param int $total_count Total de itens
     * @param int $num_buttons Número de botões de página a serem exibidos (opcional, padrão: 5)
     * @param string $url URL base para as páginas
     * @param string|null $js_function Nome da função JavaScript para eventos nos botões (opcional)
     */
    public function __construct($page = 1, $per_page = 20, $total_count = null, $num_buttons = 5, $url = null, $js_function = null) {
        $this->current_page = $this->validate_page($page);
        $this->per_page = (int)$per_page;
        $this->total_count = (int)$total_count;
        $this->num_buttons = (int)$num_buttons;
        $this->url = $url;
        $this->js_function = $js_function;
        $this->num_pages = ceil($this->total_count / $this->per_page);
    }

    public function validate_page($page) {
        return is_numeric($page) ? (int)$page : 1;
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
        return $this->previous_page() >= 1;
    }

    public function has_next_page() {
        return $this->next_page() <= $this->num_pages;
    }

    /**
     * Renderiza a navegação de páginas.
     *
     * @param int $selected_page Página selecionada para destacar
     * @return string HTML da navegação de páginas
     */
    public function render_pages($selected_page = 1) {
        $html = '';
        $start = $selected_page - floor($this->num_buttons / 2);
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
                $html .= "<li class='page-item active'><a class='page-link'> " . $i . "</a></li>";
            } else {
                $html .= $this->generate_link($i);
            }
        }

        if ($this->has_previous_page()) {
            $html = $this->generate_link($this->previous_page(), '&laquo;') . $html;
        }

        if ($this->has_next_page()) {
            $html .= $this->generate_link($this->next_page(), '&raquo;');
        }

        return '<ul class="pagination pagination-sm m-0 float-left">' . $html . '</ul>';
    }

    /**
     * Gera o link de navegação.
     *
     * @param int $page Número da página para o link
     * @param string|null $label Texto a ser exibido no link (opcional)
     * @return string HTML do link
     */
    private function generate_link($page, $label = null) {
        $label = $label ?? $page;

        // Verifica se a função JavaScript foi definida
        if ($this->js_function) {
            // Usa o evento onclick com a função JavaScript definida
            return "<li class='page-item'><a class='page-link' href='javascript:void(0)' onclick='{$this->js_function}({$page})'>" . $label . "</a></li>";
        } else {
            // Usa o link normal com URL se a função JavaScript não for fornecida
            return "<li class='page-item'><a class='page-link' href='" . $this->url . "?p=" . $page . "'>" . $label . "</a></li>";
        }
    }
}
