<h2 class="mt-4">Messages Management</h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Messages Management</li>
    </ol>
</nav>
<div class="row mt-3">
    <div class="col-md-12">
        <div class="table-responsive">
            <div class="card mb-2">
                <div class="card-body filter">
                    <form action="<?= base_url() ?>/filter-message" method="GET" class="form-inline float-md-right mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Email</label>
                                <input type="text" name="email" value="<?php echo isset($email) ? $email : '' ?>" class="form-control mr-2">
                            </div>
                            <div class="col-sm-3">
                                <label>Start Date</label>
                                <input type="date" name="start" value="<?php echo isset($start) ? $start : '' ?>" class="form-control mr-2">
                            </div>
                            <div class="col-sm-3">
                                <label>End Date</label>
                                <input type="date" name="end" value="<?php echo isset($end) ? $end : '' ?>" class="form-control mr-2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-2">
                                <button class="btn btn-outline-success">Filter</button>
                                <a href="<?= base_url() ?>/messages" class="btn btn-outline-danger">Clear</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10%" class="text-right">ID</th>
                        <th style="width: 10%" class="text-right">Time</th>
                        <th style="width: 10%" class="text-right">Date</th>
                        <th style="width: 20%">Name</th>
                        <th style="width: 20%">Email</th>
                        <th style="width: 20%">Message</th>
                        <th style="width: 10%" class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $value) : ?>
                        <tr>
                            <td id="lastId" class="text-right"><?php echo $value['message_id'] ?></td>
                            <td class="text-right"><?php echo date($settings['time_format'], strtotime($value['create_time'])) ?></td>
                            <td class="text-right"><?php echo date($settings['date_format'], strtotime($value['create_date'])) ?></td>
                            <td><?php echo $value['name'] ?></td>
                            <td><?php echo $value['email'] ?></td>
                            <td><?php echo $value['message'] ?></td>
                            <td class="text-right">
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#staticModal" class="theFile btn btn-sm btn-danger" data-id="<?php echo $value['message_id'] ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <?php
            if (isset($pager)) :
                echo $pager->links('message', 'bootstrap_pagination');
            endif;
            ?>
        </div>
    </div>
</div>
<script>
    jQ.push(function() {
        $('.theFile').click(function(e) {
            var fileId = $(this).attr('data-id');
            $("#modalLoading").html('Processing...');
            e.preventDefault();
            $.ajax({
                type: 'GET',
                url: '<?= base_url() ?>/confirmDeleteMessage/' + fileId,
                success: function(data) {
                    $("#modalLoading").html(data);
                }
            });
        });
    });
</script>
<!-- Modal -->
<div class="modal fade" id="staticModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <span id="modalLoading">

            </span>
        </div>
    </div>
</div>
<script>
    jQ.push(function() {
        $("#message").addClass('active');
    });
</script>