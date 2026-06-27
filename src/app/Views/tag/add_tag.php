<h2 class="mt-4">Add Tag</h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url() ?>/all-tags">Tag Management</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Tag</li>
    </ol>
</nav>
<form id="saveTag">
    <?= csrf_field() ?>
    <div class="row mt-3">
        <div class="col-md-12" id="result"></div>
        <div class="col-md-6">
            <div>
                <label>Tag Name</label>
                <input type="text" name="tag_name" class="form-control">
            </div>
        </div>
        <div class="mt-2">
            <button type="submit" id="submit" class="btn btn-success mb-3">Save</button>
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
                url: '<?= base_url() ?>/save-tag',
                data: $('#saveTag').serialize(),
                success: function(data) {
                    if (data === 'success') {
                        $("#submit").html('Save');
                        $("#submit").attr("disabled", false);
                        $('#saveTag')[0].reset();
                        $('#result').append("<div class='alert alert-success' role='alert'>Success</div>");
                    } else {
                        $("#submit").html('Save');
                        $("#submit").attr("disabled", false);
                        $('#saveTag')[0].reset();
                        $('#result').append("<div class='alert alert-danger' role='alert'>" + data + "</div>");
                    }
                }
            });
        });
    });
</script>