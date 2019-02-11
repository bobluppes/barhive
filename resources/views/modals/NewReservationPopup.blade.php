<!-- The Modal -->
<div class="modal" id="newReservation">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Make a Reservation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                {!! Form::open(array('url' => '/reservations')) !!}
                {!! Form::token() !!}

                <div class="row form-group">
                    <div class="col-md-4">
                        Name
                    </div>
                    <div class="col-md-8">
                        {!! Form::text('name', '', array('class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-4">
                        Email
                    </div>
                    <div class="col-md-8">
                        {!! Form::email('email', '', array('class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-4">
                        People
                    </div>
                    <div class="col-md-8">
                        {!! Form::number('people', '2', array('class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-4">
                        Start time
                    </div>
                    <div class="col-md-8">
                        {!! Form::time('start', '', array('class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-4">
                        End time
                    </div>
                    <div class="col-md-8">
                        {!! Form::time('end', '', array('class' => 'form-control')) !!}
                    </div>
                </div>

                {!! Form::submit('Create', array('class' => 'btn btn-primary')) !!}

                {!! Form::close() !!}
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>