<div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">
  <div class="navbar-header">
    <a class="navbar-brand" id="navbar-brand2" href="#">{{ HTML::image("img/bcd-logo.png", "Logo", array('class' => 'img-responsive')) }}</a>
  </div>
  <ul class="nav nav-sidebar">
    <li><a href="#"><h3>Online Forms</h3></a></li>
    <li><a href="{{ URL::route('online-forms') }}" id="loa-link">Leave of Absence</a></li>
    <li><a href="#">Overtime Authorization</a></li>
    <li><a href="#">Official Business Request</a></li>
    <hr/>
    <li><a href="#">Petty Cash Voucher</a></li>
    <li><a href="#">Check Voucher</a></li>
    <li><a href="{{ URL::route('request-for-payment') }}" id="rfp-link">Request for Payment</a></li>
  </ul>
  <br/><br/>
  <a href="{{ URL::route('dashboard')}}">Home</a>
</div>