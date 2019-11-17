  
    <div class="grid-margin">

          <hr class="my-5" id="register">
          <h4>Register</h4>
          <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/register</div>
          {!! Form::Open(['url'=>'api/v1/register']) !!}
            <div class="card-body">
                <div class="table-responsive mt-4">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>PARAMETER</th>
                        <th>TYPE</th>
                        <th>DESCRIPTION</th>
                        <th>VALUE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>name</td>
                        <td>string</td>
                        <td class="xmp"><xmp><input type="text" name="name" required></xmp></td>
                        <td><input type="text" name="name"></td>
                      </tr>
                      <tr>
                        <td>email</td>
                        <td>string</td>
                        <td class="xmp"><xmp><input type="text" name="email" required></xmp></td>
                        <td><input type="text" name="email"></td>
                      </tr>
                      <tr>
                        <td>password</td>
                        <td>password</td>
                        <td class="xmp"><xmp><input type="password" name="password" required></xmp></td>
                        <td><input type="password" name="password"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            <div class="card-footer small text-muted"><button class="btn btn-dark">Submit</button></div>
          {!! Form::Close() !!}




              <hr class="my-5" id="login">
              <h4>Login</h4>
              <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/login</div>
              {!! Form::Open(['url'=>'api/v1/login']) !!}
                  <div class="card-body">
                      <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>PARAMETER</th>
                              <th>TYPE</th>
                              <th>DESCRIPTION</th>
                              <th>VALUE</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>email</td>
                              <td>string</td>
                              <td class="xmp"><xmp><input type="text" name="email" required></xmp></td>
                              <td><input type="text" name="email"></td>
                            </tr>
                            <tr>
                              <td>password</td>
                              <td>password</td>
                              <td class="xmp"><xmp><input type="password" name="password" required></xmp></td>
                              <td><input type="password" name="password"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="card-footer small text-muted"><button class="btn btn-dark">Submit</button></div>
              {!! Form::Close() !!}




            <hr class="my-5" id="fetch-user">
            <h4>Fetch User</h4>
            <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/fetch/user</div>
              {!! Form::Open(['url'=>'api/v1/fetch/user']) !!}
                  <div class="card-body">
                      <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>PARAMETER</th>
                              <th>TYPE</th>
                              <th>DESCRIPTION</th>
                              <th>VALUE</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>accessToken</td>
                              <td>secret</td>
                              <td class="xmp"><xmp><input type="text" name="accessToken" required></xmp></td>
                              <td><input type="text" name="accessToken"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="card-footer small text-muted"><button class="btn btn-dark">Submit</button></div>
              {!! Form::Close() !!}

      </div>