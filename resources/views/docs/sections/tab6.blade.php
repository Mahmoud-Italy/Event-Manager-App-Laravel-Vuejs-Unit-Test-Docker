  
    <div class="grid-margin">

              <hr class="my-5" id="settings">
              <h4>App Settings</h4>
              <div class="card-header">GET &nbsp;&nbsp;&nbsp; api/v1/settings</div>
              {!! Form::Open(['url'=>'api/v1/settings', 'method'=>'GET']) !!}
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
                              <td colspan="4">No parameter need.</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="card-footer small text-muted"><button class="btn btn-dark">Submit</button></div>
              {!! Form::Close() !!}




              <hr class="my-5" id="update-settings">
              <h4>Update Settings</h4>
              <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/settings</div>
              {!! Form::Open(['url'=>'api/v1/settings', 'files'=>true ]) !!}
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
                              <td><input type="text" name="accessToken" required></td>
                            </tr>
                            <tr>
                              <td>logo</td>
                              <td>file</td>
                              <td class="xmp"><xmp><input type="file" name="logo"></xmp></td>
                              <td><input type="file" name="logo"></td>
                            </tr>
                            <tr>
                              <td>title</td>
                              <td>string</td>
                              <td class="xmp"><xmp><input type="text" name="title"></xmp></td>
                              <td><input type="text" name="title"></td>
                            </tr>
                            <tr>
                              <td>email</td>
                              <td>string</td>
                              <td class="xmp"><xmp><input type="text" name="email"></xmp></td>
                              <td><input type="text" name="email"></td>
                            </tr>
                            <tr>
                              <td>mobile</td>
                              <td>string</td>
                              <td class="xmp"><xmp><input type="text" name="mobile"></xmp></td>
                              <td><input type="text" name="mobile"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="card-footer small text-muted"><button class="btn btn-dark">Submit</button></div>
              {!! Form::Close() !!}



      </div>