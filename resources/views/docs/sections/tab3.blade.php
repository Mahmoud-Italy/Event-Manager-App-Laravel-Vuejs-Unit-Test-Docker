  
    <div class="grid-margin">

          <hr class="my-5" id="dashboard">
          <h4>Dashboard</h4>
          <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/dashboard</div>
          {!! Form::Open(['url'=>'api/v1/dashboard']) !!}
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
                    </tbody>
                  </table>
                </div>
              </div>
            <div class="card-footer small text-muted"><button class="btn btn-dark">Submit</button></div>
          {!! Form::Close() !!}




              <hr class="my-5" id="meetings">
              <h4>Meetings</h4>
              <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/meetings</div>
              {!! Form::Open(['url'=>'api/v1/meetings']) !!}
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




              <hr class="my-5" id="create-meeting">
              <h4>Create Meeting</h4>
              <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/meetings/create</div>
              {!! Form::Open(['url'=>'api/v1/meetings/create', 'files'=>true]) !!}
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
                              <td>location</td>
                              <td>string</td>
                              <td class="xmp"><xmp><input type="text" name="location"></xmp></td>
                              <td><input type="text" name="location"></td>
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





              <hr class="my-5" id="edit-meeting">
              <h4>Edit Meeting</h4>
              <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/meeting/edit</div>
              {!! Form::Open(['url'=>'api/v1/meeting/edit']) !!}
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
                              <td>meeting_id</td>
                              <td>integer</td>
                              <td class="xmp"><xmp><input type="text" name="meeting_id" required></xmp></td>
                              <td><input type="text" name="meeting_id" required></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="card-footer small text-muted"><button class="btn btn-dark">Submit</button></div>
              {!! Form::Close() !!}


            <hr class="my-5" id="update-meeting">
            <h4>Update Meeting</h4>
            <div class="card-header">PUT &nbsp;&nbsp;&nbsp; api/v1/meeting/update</div>
              {!! Form::Open(['url'=>'api/v1/meeting/update', 'method'=>'PUT', 'files'=>true]) !!}
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
                              <td>meeting_id</td>
                              <td>integer</td>
                              <td class="xmp"><xmp><input type="text" name="meeting_id" required></xmp></td>
                              <td><input type="text" name="meeting_id" required></td>
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
                              <td>location</td>
                              <td>string</td>
                              <td class="xmp"><xmp><input type="text" name="location"></xmp></td>
                              <td><input type="text" name="location"></td>
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


              <hr class="my-5" id="invite-meeting">
            <h4>Invite Member to Meeting</h4>
            <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/meeting/invite/member</div>
              {!! Form::Open(['url'=>'api/v1/meeting/invite/member']) !!}
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
                              <td>meeting_id</td>
                              <td>integer</td>
                              <td class="xmp"><xmp><input type="text" name="meeting_id" required></xmp></td>
                              <td><input type="text" name="meeting_id" required></td>
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



            <hr class="my-5" id="remove-meeting">
            <h4>Remove Member from Meeting</h4>
            <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/meeting/remove/member</div>
              {!! Form::Open(['url'=>'api/v1/meeting/remove/member']) !!}
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
                              <td>meeting_id</td>
                              <td>integer</td>
                              <td class="xmp"><xmp><input type="text" name="meeting_id" required></xmp></td>
                              <td><input type="text" name="meeting_id" required></td>
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


              <hr class="my-5" id="active-meeting">
              <h4>Active\deactive Meeting</h4>
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
                              <td class="xmp"><xmp><input type="text" name="modelName" required value="Meeting"></xmp></td>
                              <td><input type="text" name="modelName" value="Meeting" required ></td>
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


              <hr class="my-5" id="destroy-meeting">
            <h4>Destroy Meeting</h4>
            <div class="card-header">DELETE &nbsp;&nbsp;&nbsp; api/v1/meeting</div>
              {!! Form::Open(['url'=>'api/v1/meeting/destroy', 'method'=>'DELETE']) !!}
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
                              <td>meeting_id</td>
                              <td>integer</td>
                              <td class="xmp"><xmp><input type="text" name="meeting_id" required></xmp></td>
                              <td><input type="text" name="meeting_id" required></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="card-footer small text-muted"><button class="btn btn-dark">Submit</button></div>
              {!! Form::Close() !!}

      </div>