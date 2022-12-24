<?php
$this->data['param'] = $param;
$this->data['js'] = $js;
$this->load->view('template/header.php');
$this->load->view('template/navbar.php');
$this->load->view('template/sidebar.php');
$this->load->view($view, $this->data);
$this->load->view('template/footer.php', $this->data);
