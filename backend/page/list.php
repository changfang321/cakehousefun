<?php
require_once('../function/login_check.php');
require('../../connection/connection.php'); ?>
<?php 

$limit = 3;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $limit;

$query = $db->query("SELECT * FROM pages ORDER BY pages_id ASC LIMIT ".$start_from.",". $limit);
$data = $query->fetchAll(PDO::FETCH_ASSOC);

$totalRows = count($data);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="../css/theme.css" type="text/css"> 
  
</head>

<body>
<?php require_once('../function/backend_nav.php'); ?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="">頁面管理</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5 text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-left">
          <ul class="breadcrumb" style="margin-bottom: 0px; margin-top: 0px;">
            <li class="breadcrumb-item">
              <a href="#">主控台</a>
            </li>
            <li class="breadcrumb-item active">頁面管理</li>
          </ul>

        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
        <hr>
        <?php if($totalRows > 0){ ?>
          <table class="table">
            <thead>
              <tr>
               
                <th>標題</th>
                <th>內容</th>
                <th width="15%">操作</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data as $pages){  ?>
              <tr>
               
                <td class="text-left"><?php echo $pages['title']; ?></td>
                <td class="text-left"><?php echo mb_strimwidth($pages['content'],0,100,"..."); ?></td>
                <td>
                  <a href="edit.php?pages_id=<?php echo $pages['pages_id']; ?>" class="btn btn-outline-primary">編輯</a>
                  
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <?php }else{ ?>
              <p>
                目前無資料，請新增一筆。
              </p>
              <?php } ?>
        </div>
      </div>
      <?php  if($totalRows > 0){
            $sth = $db->query("SELECT * FROM pages ORDER BY pages_id DESC ");
            $data_count = count($sth ->fetchAll(PDO::FETCH_ASSOC));
            $total_pages = ceil($data_count / $limit);
           ?>
        <div class="row">
          <div class="col-md-12 text-center">
            <ul class="pagination">
                <li class ="page item">
                <?php   if($page > 1){ ?>
                  <a class="page-link" href="list.php?page=<?php echo $page-1;?>">
                  <span><<</span>
                  <span class="se-only"></span>
                  </a> 

                <?php }else{ ?>
                    <span class="page-link"> <<</span>
                  <?php } ?>
                </li>
              <?php for ($i=1; $i<=$total_pages; $i++) { ?>
              <li class ="page item">
                <a class="page-link" href="list.php?page=<?php echo $i;?>"><?php echo $i;?></a>
              </li>
              <?php } ?>
              <li class ="page item">
              <?php if($page < $total_pages){ ?>
                <a class="page-link" href="list.php?page=<?php echo $page+1;?>">
                <span>>></span>
                <span class="sr-only">next</span>
                </a>
              <?php }else{ ?>
                <span class ="page-link">>></span>
                <?php } ?>
                </li>
            </ul>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    
  <div class="py-5 bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mt-3 text-center">
          <p>© Copyright 2018 Funz - All rights reserved.</p>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <pingendo onclick="window.open('https://pingendo.com/', '_blank')" style="cursor:pointer;position: fixed;bottom: 10px;right:10px;padding:4px;background-color: #00b0eb;border-radius: 8px; width:250px;display:flex;flex-direction:row;align-items:center;justify-content:center;font-size:14px;color:white">Made with Pingendo Free&nbsp;&nbsp;
    <img src="https://pingendo.com/site-assets/Pingendo_logo_big.png" class="d-block" alt="Pingendo logo" height="16">
  </pingendo>
</body>

</html>