<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Token List <small>Tokens</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a>
                </li>
                <li><a href="#">Settings 2</a>
                </li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <table id="datatable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Email</th>
                <th>Token</th>
                <th>Updated</th>
              </tr>
            </thead>


            <tbody>
            <?php $data = $this->AdminModel->tokenDetails();
              if(isset($data)) { 
                foreach ($data as $row) { ?>
                <tr>
                  <td><?php echo $row->email;  ?></td>
                  <td><?php echo $row->token;  ?></td>
                  <td><?php echo date("d F Y", $row->updated_at);  ?></td>
                </tr>
              <?php } } ?>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>