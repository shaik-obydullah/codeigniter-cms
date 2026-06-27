<h2 class="mt-4">Edit The Tag</h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url() ?>/all-tags">Tag Management</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit The Tag</li>
    </ol>
</nav>
<form id="saveTag">
    <?= csrf_field() ?>
    <div class="row mt-3">
        <div class="col-md-12" id="result"></div>
        <div class="col-md-6">
            <div>
                <label>Tag Name</label>
                <input type="text" name="tag_name" value="<?php echo $tag_info['tag_name'] ?>" class="form-control">
                <input type="hidden" name="tag_id" value="<?php echo $tag_info['tag_id'] ?>">
            </div>
        </div>
        <div class="mt-2">
            <button type="submit" id="submit" class="btn btn-success mb-3">Update</button>
        </div>
    </div>
</form>
<script>
    jQ.push(function() {
        $("#tag").addClass('active');

        $('#submit').click(function(e) {
            $("#submit").attr("disabled", true);
            $("#submit").html('Processing..');
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>/update-tag',
                data: $('#saveTag').serialize(),
                success: function(data) {
                    if (data === 'success') {
                        $("#submit").html('Update');
                        $("#submit").attr("disabled", false);
                        $('#result').append("<div class='alert alert-primary' role='alert'>Success</div>");
                    } else {
                        $("#submit").html('Update');
                        $("#submit").attr("disabled", false);
                        $('#result').append("<div class='alert alert-danger' role='alert'>" + data + "</div>");
                    }
                }
            });
        });
    });
</script>