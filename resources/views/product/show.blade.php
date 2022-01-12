<div class="row">

                        <div class="col-md-3" style="left:20px;">
                            <div class="form-group d-flex">
                                <label class="col-md-2" for="myselect">صنف</label>
                                <div style="margin-right: -20px;">
                                    <select name="cast_id" id="myselect" multiple style="right:10px; width:250px; ">
                                        @foreach($casts as $cast)
                                            <option value="{{$cast->id}}">{{$cast->cast}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3" style="left:-10px;">
                            <div class="form-group d-flex" >
                                <label class="col-md-3" for="product" style="margin-right:-30px;">محصول</label>
                                <input type="text" id="product" name="product" placeholder="محصول" class="form-control" style="margin-right:-40px; width:300px;">
                            </div>
                        </div>

                        @can('Get_Permission_To_Other_User') 
                            <div class="col-md-3" style="left:15px;"> 
                                <div class="form-group d-flex"> 
                                    <label class="col-md-3" for="myselect-2" >نام کاربر</label> 
                                    <div style="margin-right:-40px;"> 
                                        <select name="user_id" id="myselect-2" multiple class="form-control show-user" style="width:300px; " > 
                                        </select> 
                                    </div> 
                                </div> 
                            </div> 
                        @endcan 

                        <div class="col-md-3" >
                            <div class="form-group">
                                <input type="submit" value="جستجو" class="btn btn-primary" >
                            </div>
                        </div>

                    </div>