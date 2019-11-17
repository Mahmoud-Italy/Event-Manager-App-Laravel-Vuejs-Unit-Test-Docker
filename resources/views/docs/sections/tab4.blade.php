  
    <div class="grid-margin">

              <hr class="my-5" id="calls">
              <h4>Calls</h4>
              <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/calls</div>
              {!! Form::Open(['url'=>'api/v1/calls']) !!}
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
                              <td>search</td>
                              <td>string</td>
                              <td class="xmp"><xmp><input type="text" name="search"></xmp></td>
                              <td><input type="text" name="search"></td>
                            </tr>
                            <tr>
                              <td>pagination</td>
                              <td>integer</td>
                              <td class="xmp"><xmp><input type="text" name="pagination"></xmp></td>
                              <td><input type="text" name="pagination"></td>
                            </tr>
                            <tr>
                              <td>page</td>
                              <td>integer</td>
                              <td class="xmp"><xmp><input type="text" name="page"></xmp></td>
                              <td><input type="text" name="page"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="card-footer small text-muted"><button class="btn btn-dark">Submit</button></div>
              {!! Form::Close() !!}




              <hr class="my-5" id="create-call">
              <h4>Create Call</h4>
              <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/call/create</div>
              {!! Form::Open(['url'=>'api/v1/call/create', 'files'=>true]) !!}
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
                              <td>image</td>
                              <td>file</td>
                              <td class="xmp"><xmp><input type="file" name="image"></xmp></td>
                              <td><input type="file" name="image"></td>
                            </tr>
                            <tr>
                              <td>title</td>
                              <td>text</td>
                              <td class="xmp"><xmp><input type="text" name="title" required></xmp></td>
                              <td><input type="text" name="title" required></td>
                            </tr>
                            <tr>
                              <td>content</td>
                              <td>text</td>
                              <td class="xmp"><xmp><input type="text" name="content"></xmp></td>
                              <td><input type="text" name="content"></td>
                            </tr>
                            <tr>
                              <td>start_dateTime</td>
                              <td>datetime</td>
                              <td class="xmp"><xmp><input type="datetime-local" name="start_dateTime" required></xmp></td>
                              <td><input type="datetime-local" name="start_dateTime" required></td>
                            </tr>
                            <tr>
                              <td>end_dateTime</td>
                              <td>datetime</td>
                              <td class="xmp"><xmp><input type="datetime-local" name="end_dateTime" required></xmp></td>
                              <td><input type="datetime-local" name="end_dateTime" required></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="card-footer small text-muted"><button class="btn btn-dark">Submit</button></div>
              {!! Form::Close() !!}





              <hr class="my-5" id="edit-call">
              <h4>Edit Call</h4>
              <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/call/edit</div>
              {!! Form::Open(['url'=>'api/v1/call/edit']) !!}
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
                              <td>call_id</td>
                              <td>integer</td>
                              <td class="xmp"><xmp><input type="text" name="call_id" required></xmp></td>
                              <td><input type="text" name="call_id" required></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="card-footer small text-muted"><button class="btn btn-dark">Submit</button></div>
              {!! Form::Close() !!}


            <hr class="my-5" id="update-call">
            <h4>Update Call</h4>
            <div class="card-header">PUT &nbsp;&nbsp;&nbsp; api/v1/call/update</div>
              {!! Form::Open(['url'=>'api/v1/call/update', 'method'=>'PUT', 'files'=>true]) !!}
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
                              <td>call_id</td>
                              <td>integer</td>
                              <td class="xmp"><xmp><input type="text" name=>call_id" required></xmp></td>
                              <td><input type="text" name=>call_id" required></td>
                            </tr>
                            <tr>
                              <td>image</td>
                              <td>file</td>
                              <td class="xmp"><xmp><input type="file" name="image"></xmp></td>
                              <td><input type="file" name="image"></td>
                            </tr>
                            <tr>
                              <td>title</td>
                              <td>text</td>
                              <td class="xmp"><xmp><input type="text" name="title"></xmp></td>
                              <td><input type="text" name="title"></td>
                            </tr>
                            <tr>
                              <td>content</td>
                              <td>text</td>
                              <td class="xmp"><xmp><input type="text" name="content"></xmp></td>
                              <td><input type="text" name="content"></td>
                            </tr>
                            <tr>
                              <td>start_dateTime</td>
                              <td>datetime</td>
                              <td class="xmp"><xmp><input type="datetime-local" name="start_dateTime"></xmp></td>
                              <td><input type="datetime-local" name="start_dateTime"></td>
                            </tr>
                            <tr>
                              <td>end_dateTime</td>
                              <td>datetime</td>
                              <td class="xmp"><xmp><input type="datetime-local" name="end_dateTime"></xmp></td>
                              <td><input type="datetime-local" name="end_dateTime"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="card-footer small text-muted"><button class="btn btn-dark">Submit</button></div>
              {!! Form::Close() !!}


              <hr class="my-5" id="invite-call">
            <h4>Invite Member to Call</h4>
            <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/call/invite/members</div>
              {!! Form::Open(['url'=>'api/v1/call/invite/members']) !!}
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
                              <td>call_id</td>
                              <td>integer</td>
                              <td class="xmp"><xmp><input type="text" name="call_id" required></xmp></td>
                              <td><input type="text" name="call_id" required></td>
                            </tr>
                            <tr>
                              <td>user_id</td>
                              <td>integer</td>
                              <td class="xmp"><xmp><input type="text" name="user_id" required></xmp></td>
                              <td><input type="text" name="user_id" required></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="card-footer small text-muted"><button class="btn btn-dark">Submit</button></div>
              {!! Form::Close() !!}



            <hr class="my-5" id="remove-call">
            <h4>Remove Member from Call</h4>
            <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/call/remove/members</div>
              {!! Form::Open(['url'=>'api/v1/call/remove/members']) !!}
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
                              <td>call_id</td>
                              <td>integer</td>
                              <td class="xmp"><xmp><input type="text" name="call_id" required></xmp></td>
                              <td><input type="text" name="call_id" required></td>
                            </tr>
                            <tr>
                              <td>user_id</td>
                              <td>integer</td>
                              <td class="xmp"><xmp><input type="text" name="user_id" required></xmp></td>
                              <td><input type="text" name="user_id" required></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="card-footer small text-muted"><button class="btn btn-dark">Submit</button></div>
              {!! Form::Close() !!}


              <hr class="my-5" id="active-call">
              <h4>Active\deactive Call</h4>
              <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/row/status</div>
              {!! Form::Open(['url'=>'api/v1/row/status']) !!}
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
                              <td>modelName</td>
                              <td>text</td>
                              <td class="xmp"><xmp><input type="text" name="modelName" required value="Call"></xmp></td>
                              <td><input type="text" name="modelName" value="Call" required ></td>
                            </tr>
                            <tr>
                              <td>rowId</td>
                              <td>integer</td>
                              <td class="xmp"><xmp><input type="text" name="rowId" required></xmp></td>
                              <td><input type="text" name="rowId" required></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="card-footer small text-muted"><button class="btn btn-dark">Submit</button></div>
              {!! Form::Close() !!}


              <hr class="my-5" id="destroy-call">
            <h4>Destroy Call</h4>
            <div class="card-header">DELETE &nbsp;&nbsp;&nbsp; api/v1/call/destroy</div>
              {!! Form::Open(['url'=>'api/v1/call/destroy', 'method'=>'DELETE']) !!}
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
                              <td>call_id</td>
                              <td>integer</td>
                              <td class="xmp"><xmp><input type="text" name="call_id" required></xmp></td>
                              <td><input type="text" name="call_id" required></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="card-footer small text-muted"><button class="btn btn-dark">Submit</button></div>
              {!! Form::Close() !!}

      </div>