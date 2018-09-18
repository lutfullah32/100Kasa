<?php 
session_start();
if(isset($_SESSION["login"])){

?>

<!doctype html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
      .nav-item{
        margin:5px;
      }
      body{
        background-color:#FFEFD5;
      }
      .row{
        padding:20px;
      }
      .input-group{
        margin-bottom:7px;
      }
    </style>
    <title>100KASA</title>
  </head>
  <body>
  <div class="container">
    <ul class="nav justify-content-center" style="margin-top:20px">
      <li class="nav-item">
        <a class="btn btn-primary" href="#">Durum</a>
      </li>
      <li class="nav-item">
        <a class="btn btn-success" href="#">Gelir</a>
      </li>
      <li class="nav-item">
        <a class="btn btn-danger" href="#">Gider</a>
      </li>
    </ul>
    <div class="row">
      <div class="card text-white bg-warning ekle" >
        <div class="card-header">Ekle</div>
          <div class="card-body">
            <div class="btn-group btn-group-toggle input-group" data-toggle="buttons">
              <label class="btn btn-success" id="gelir">
                <input type="radio" name="durum" autocomplete="off" value="gelir"> Gelir
              </label>
              <label class="btn btn-danger" id="gider">
                <input type="radio" name="durum" autocomplete="off" value="gider"> Gider
              </label>
            </div>  

            <div class="input-group ">
              <div class="input-group-prepend">
                <span class="input-group-text">₺</span>
              </div>
              <input type="text" name="tutar" class="form-control" aria-label="Amount (to the nearest dollar)">
              <div class="input-group-append">
                <span class="input-group-text">.00</span>
              </div>
            </div>
            <div class="input-group">
              <select id="secenek" class="custom-select" name="secenek" id="inputGroupSelect01">
                <option selected>Harcama Türü/Gelir Türü</option>
              </select>
            </div>
            <button type="button" class="btn btn-info" name="ekle">Kaydet</button>
          </div>
        </div>

      </div>
  </div>
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        $(function(){
            $("#gelir").click(function(){
              $('.ekle').addClass('bg-success').removeClass('bg-warning').removeClass('bg-danger');
              $(".card-header").text("Gelir Ekle");
              $.ajax({
                type:"post",
                url:"sayfalar/gelir_gider_secenekleri.php",
                data:{"option":"gelir"},
                dataType:"json",
                success:function (data) {
                  $('#secenek')
                      .find('option')
                      .remove()
                      .end().append($('<option>', {
                        value: "",
                        text: "Bir gelir türü seçiniz.."
                    }));
                  $.each(data,function(i,item){
                    $('#secenek').append($('<option>', {
                        value: item.key,
                        text: item.value
                    }));
                  })
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  alert(xhr.status);
                  alert(thrownError);
                }
              });
            });
            $("#gider").click(function(){
              $('.ekle').addClass('bg-danger').removeClass('bg-warning').removeClass('bg-success');
              $(".card-header").text("Gider Ekle");
              $.ajax({
                type:"post",
                url:"sayfalar/gelir_gider_secenekleri.php",
                data:{"option":"gider"},
                dataType:"json",
                success:function (data) {
                  $('#secenek')
                      .find('option')
                      .remove()
                      .end().append($('<option>', {
                        value: "",
                        text: "Bir gider türü seçiniz.."
                    }));
                  $.each(data,function(i,item){
                    $('#secenek').append($('<option>', {
                        value: item.key,
                        text: item.value
                    }));
                  })
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  alert(xhr.status);
                  alert(thrownError);
                }
              });
            });
            $("[name='ekle']").click(function(){
              var durum= $("[name='durum']:checked").val();
              var tutar=$("[name='tutar']").val();
              var secenek=$("#secenek").val();
              $.ajax({
                  type:"post",
                  url:"sayfalar/gelir_gider_ekle.php",
                  data:{"durum":durum,"tutar":tutar,"secenek":secenek},
                  dataType:"json",
                  success:function (data) {
                      $("[name='tutar']").val("");
                      //$("[name='tutar']").text("");
                      $('.ekle').addClass('bg-warning').removeClass('bg-success').removeClass('bg-danger');
                      $('#secenek')
                          .find('option')
                          .remove()
                          .end().append($('<option>', {
                          value: "",
                          text: "Harcama Türü/Gelir Türü"
                      }));
                      $(".card-header").text("Ekle");
                      if(durum=="gider"){
                          alert("Harcamanız eklendi.");
                      }else if(durum="gelir"){
                          alert("Geliriniz eklendi.");
                      }
                  }
              });
            });
        });
        
    
      </script>
  </body>
</html>
      <?php } else {
        include "sayfalar/login.php";
      }
      
      ?>