<section id="wrapper" >
  <div class="login-box">
    <div class="white-box">
      <div class="title_mod">
          <h2 class="box-title-two"><p class="inline" >Ocean</p> <p class="inline subtitle">Maya Royale</p>
          <br>
          <p class="box-title-two simbolos">*****</p></h2>
      </div>

        <h3 class="box-title m-b-0 center-align">{{ trans('login.title') }}</h3>
        <center>
          <small>{{ trans('login.subtitle') }}</small>
        </center>

      <!-- <form class="form-horizontal" id="loginform" action="index.html"> -->
      <form class="form-horizontal" id="loginform" name="loginform" method="POST" action="http://{{ isset($_GET['sip']) ? $_GET['sip'] : '' }}:9997/login">
        <div class="form-group  m-t-20">
          <div class="col-xs-12">
            <label>{{ trans('login.email_address') }}</label>
            <input id="email_addess" name="email_addess" class="form-control" type="email" required="" placeholder="{{ trans('login.email_address') }}">
          </div>
          <div class="information-hidden">
            {{ csrf_field() }}
            <input class="form-control" type="hidden" id="username" name="username" value="GUESTOMR" />
            <input class="form-control" type="hidden" id="password" name="password" value="123" />
            <input class="form-control" type="hidden" id="sip" name="sip" value="{{ isset($_GET['sip']) ? $_GET['sip'] : '' }}" />
            <input class="form-control" type="hidden" id="mac" name="mac" value="{{ isset($_GET['mac']) ? $_GET['mac'] : '' }}" />
            <input class="form-control" type="hidden" id="client_mac" name="client_mac" value="{{ isset($_GET['client_mac']) ? $_GET['client_mac'] : '' }}" />
            <input class="form-control" type="hidden" id="uip" name="uip" value="{{ isset($_GET['uip']) ? $_GET['uip'] : '' }}" />
            <input class="form-control" type="hidden" id="ssid" name="ssid" value="{{ isset($_GET['ssid']) ? $_GET['ssid'] : '' }}" />
            <input class="form-control" type="hidden" id="vlan" name="vlan" value="{{ isset($_GET['vlan']) ? $_GET['vlan'] : '' }}" />
            <input class="form-control" type="hidden" id="res" name="res" value="{{ isset($_GET['res']) ? $_GET['res'] : '' }}" />
            <input class="form-control" type="hidden" id="auth" name="auth" value="{{ isset($_GET['auth']) ? $_GET['auth'] : '' }}">
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <div class="checkbox checkbox-info pull-left p-t-0">
              <input id="checkbox-signup" name="checkbox-signup"type="checkbox">
              <label for="checkbox-signup"><p id='texto-terminos'> {{ trans('login.agree') }}</p></label>
            </div>
            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right" data-toggle="modal" data-target="#responsive-modal"><i class="fa fa-info-circle m-r-5"></i> {{ trans('login.terms') }}</a>
          </div>
        </div>


        <div class="form-group  m-t-20">
          <div class="col-xs-12">
            <label for="captcha">{{ trans('login.catcha') }}</label>
            {!!Recaptcha::render()!!}
          </div>
        </div>

        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button id="btnlogin" class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="button">{{ trans('login.access') }}</button>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 m-t-20 text-center">
              <h3 class="box-title m-b-0 center-align"><b>-{{ trans('login.or') }}-</b></h3>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
            <div class="social">
              <a href="javascript:void(0)" class="btn btn-twitter" data-toggle="tooltip"  title="Login with twitter">
                <i aria-hidden="true" class="fa fa-twitter-square"></i>
              </a>
              <a href="javascript:void(0)" class="btn btn-facebook" data-toggle="tooltip"  title="Login with Facebook">
                <i aria-hidden="true" class="fa fa-facebook-official"></i>
              </a>
              <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip"  title="Login with Google">
                <i aria-hidden="true" class="fa fa-google-plus-official"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p>{{ trans('login.change_language') }}
              <a href="{{ url('lang/es') }}" class="text-dark m-l-5"><img src="./images/flags/es.png" class="img-circle" alt="User Image"><b> {{ trans('login.lang_one') }}</b></a>
              <a href="{{ url('lang/en') }}" class="text-dark m-l-5"><img src="./images/flags/en.png" class="img-circle" alt="User Image"><b> {{ trans('login.lang_two') }}</b></a>
            </p>
          </div>
        </div>

      </form>

    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
          <div class="white-box">
              <!-- sample modal content -->
              <!-- /.modal -->
              <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              <h4 class="modal-title">{{ trans('termsofuse.title') }}</h4> </div>
                          <div class="modal-body">
                            <ul class="list-unstyled">
                              <li>{{ trans('termsofuse.paragraph') }}
                                <ul>
                                  <li>
                                    {{ trans('termsofuse.paragraph_one') }}
                                  </li>
                                  <li>
                                    {{ trans('termsofuse.paragraph_two') }}
                                  </li>
                                  <li>
                                    {{ trans('termsofuse.paragraph_three') }}
                                  </li>
                                </ul>
                              </li>
                              <li>{{ trans('termsofuse.paragraph_four') }}</li>
                            </ul>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">{{ trans('termsofuse.close_modal') }}</button>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- Button trigger modal -->
          </div>
    </div>
  </div>
</section>
