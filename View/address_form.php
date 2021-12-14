<form>
  <div class="container">
    <div class="row"><?php $addAddressView->draw(); ?></div>
    <div class="row"><p> </p></div>
    <div class="row">
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary" onclick="this.form.submit();">送出地址</button>
      </div>
    </div>
  </div>
</form>