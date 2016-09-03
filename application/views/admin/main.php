<div class="main_container">

    <?php $this->load->view('admin/common/navigation'); ?>

    <?php $this->load->view('admin/common/header'); ?>

    <div class="right_col" role="main">
      <?php $this->AdminModel->loadView($uri); ?>
    </div> 

    <?php $this->load->view('admin/common/footer'); ?>

</div>