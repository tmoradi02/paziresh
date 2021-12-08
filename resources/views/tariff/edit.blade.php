
    <!-- ST DOC 1400-09-09 ADD Modal Form For Create New Record -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">اضافه نمودن تعرفه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST DOC Form Create -->
                    <form action="{{route('tariff.store')}}" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select name="channel_id" id="channel-id" class="form-control show-channel">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <select name="classes_id" id="classes-id" class="form-control show-class">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select name="box_type_id" id="box-type-id" class="form-control show-BoxType">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="number" name="price" id="price" class="form-control" placeholder="مبلغ">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input data-jdp name="from_date" class="form-control" placeholder="از تاریخ">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input data-jdp name ="to_date" class="form-control" placeholder="تا تاریخ">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group"  style="width:210px;">
                                        <select name="user_id" id="user-id" class="form-control show-user">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="submit" value="ثبت"  class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                <div class="col"></div>
                            </div>
                        </div>
                    </form>
                    <!-- END DOC Form Create -->
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- END DOC 1400-09-09 ADD Modal Form For Create New Record -->