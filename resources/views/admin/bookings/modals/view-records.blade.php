<div id="myModal_{{ $record->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Booking Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <h5 class="fs-15">

                </h5>
                <div class="table-responsive">
                    <table class="table table-sm table-nowrap">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Status</th>
                            <th scope="col">Assignee</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Implement new UX</td>
                            <td><span class="badge badge-soft-primary">Backlog</span></td>
                            <td>Lanora Sandoval</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Design syntax</td>
                            <td><span class="badge badge-soft-secondary">In Progress</span></td>
                            <td>Calvin Garrett</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Configurable resources</td>
                            <td><span class="badge badge-soft-success">Done</span></td>
                            <td>Florence Guzman</td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>Implement extensions</td>
                            <td><span class="badge badge-soft-dark">Backlog</span></td>
                            <td>Maritza Blanda</td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Applications Engineer</td><td>
                                <span class="badge badge-soft-success">Done</span></td>
                            <td>Leslie Alexander</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Check Guest Out</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
