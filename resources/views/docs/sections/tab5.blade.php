  
    <div class="grid-margin">

              <hr class="my-5" id="list_members">
              <h4>List Members</h4>
              <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/list/members</div>
              {!! Form::Open(['url'=>'api/v1/list/members']) !!}
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


              <hr class="my-5" id="members">
              <h4>Members</h4>
              <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/members</div>
              {!! Form::Open(['url'=>'api/v1/members']) !!}
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




              <hr class="my-5" id="member-meetings">
              <h4>View Member Meetings</h4>
              <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/member/meetings</div>
              {!! Form::Open(['url'=>'api/v1/member/meetings']) !!}
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


              <hr class="my-5" id="member-calls">
              <h4>View Member Calls</h4>
              <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/member/calls</div>
              {!! Form::Open(['url'=>'api/v1/member/calls']) !!}
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





              <hr class="my-5" id="suspend-member">
              <h4>Suspend Member</h4>
              <div class="card-header">POST &nbsp;&nbsp;&nbsp; api/v1/member/suspend</div>
              {!! Form::Open(['url'=>'api/v1/member/suspend']) !!}
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


              <hr class="my-5" id="active-member">
              <h4>Active\deactive Member</h4>
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
                              <td class="xmp"><xmp><input type="text" name="modelName" required value="User"></xmp></td>
                              <td><input type="text" name="modelName" value="User" required ></td>
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


            <hr class="my-5" id="destroy-member">
            <h4>Destroy Member</h4>
            <div class="card-header">DELETE &nbsp;&nbsp;&nbsp; api/v1/member/destroy</div>
              {!! Form::Open(['url'=>'api/v1/member/destroy', 'method'=>'DELETE']) !!}
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


      </div>